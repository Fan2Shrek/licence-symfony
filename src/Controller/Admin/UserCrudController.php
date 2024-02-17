<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use Symfony\Contracts\Translation\TranslatorInterface;

class UserCrudController extends AbstractCrudController
{
    use ActionsTrait;

    public function __construct(
        private TranslatorInterface $translator,
    ) {
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield TextField::new('email');
        yield ArrayField::new('roles');
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->disable(Action::NEW);
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', $this->translator->trans('crud.index', ['%name%' => 'utilisateurs']))
            ->setPageTitle('edit', fn ($user) => 'Modifier ' . $user->getUserIdentifier())
            ->setPageTitle('new', $this->translator->trans('crud.new'));
    }

    public function createEntity($entityFqcn): object
    {
        return new User('', '');
    }
}
