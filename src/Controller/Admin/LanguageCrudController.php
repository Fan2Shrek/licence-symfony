<?php

namespace App\Controller\Admin;

use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Contracts\Translation\TranslatorInterface;

class LanguageCrudController extends AbstractCrudController
{
    use ActionsTrait;

    public function __construct(
        private TranslatorInterface $translator,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return Language::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', $this->translator->trans('crud.index', ['%name%' => 'langages']))
            ->setPageTitle('edit', fn ($language) => 'Modifier ' . $language->getName())
            ->setPageTitle('new', $this->translator->trans('crud.new', ['%name%' => 'projet']));
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
        ];
    }
}
