<?php

namespace App\Controller\Admin;

use App\Entity\Project;
use App\Repository\CategoryRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
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
        $imageField = ImageField::new('imagePath', $this->translator->trans('image'))->hideOnIndex()->setUploadDir('public/img/projects/');
        if ($pageName != 'new') {
            $imageField->setRequired(false);
        }

        yield TextField::new('name', $this->translator->trans('name'));
        yield TextEditorField::new('description', $this->translator->trans('description'))->hideOnIndex();
        yield AssociationField::new('category', $this->translator->trans('category'))->renderAsNativeWidget()->setFormTypeOption('choice_label', 'name');
        yield $imageField;
        yield AssociationField::new('languages')->setFormTypeOption('choice_label', 'name');
        yield TextField::new('link', $this->translator->trans('link'));
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
