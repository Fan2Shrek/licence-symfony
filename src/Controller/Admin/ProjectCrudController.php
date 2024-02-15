<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Repository\CategoryRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use Symfony\Contracts\Translation\TranslatorInterface;

class ProjectCrudController extends AbstractCrudController
{
    use ActionsTrait;

    public function __construct(
        private CategoryRepository $categoryRepository,
        private TranslatorInterface $translator,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', $this->translator->trans('crud.index', ['%name%' => 'projets']))
            ->setPageTitle('edit', fn ($project) => $this->translator->trans('project.edit',   ['%name%' => $project->getName()]))
            ->setPageTitle('new', $this->translator->trans('crud.new', ['%name%' => 'projet']))
            ->setDefaultSort(['name' => 'ASC']);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', $this->translator->trans('name')),
            TextField::new('link', $this->translator->trans('link')),
            TextEditorField::new('description', $this->translator->trans('description'))->hideOnIndex(),
            AssociationField::new('category', $this->translator->trans('category'))->renderAsNativeWidget()->setFormTypeOption('choice_label', 'name'),
            AssociationField::new('languages')->setFormTypeOption('choice_label', 'name'),
        ];
    }

    public function createEntity(string $entityFqcn)
    {
        return new Project(
            '',
            '',
            new \DateTime(),
            $this->categoryRepository->findBy([], ['id' => 'ASC'])[0],
        );
    }
}
