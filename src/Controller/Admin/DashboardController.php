<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Language;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Project;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Controller\Admin\ProjectCrudController;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use Symfony\Contracts\Translation\TranslatorInterface;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private TranslatorInterface $translator
    ) {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(ProjectCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Osez Projet');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard($this->translator->trans('dashboard.index'), 'fa fa-home');
        yield MenuItem::linkToRoute($this->translator->trans('dashboard.home'), 'fa fa-backward', 'home');

        yield MenuItem::section($this->translator->trans('dashboard.session.crud'));
        yield MenuItem::linkToCrud($this->translator->trans('dashboard.crud.project'), 'fa fa-list-check', Project::class);
        yield MenuItem::linkToCrud($this->translator->trans('dashboard.crud.category'), 'fa fa-list', Category::class);
        yield MenuItem::linkToCrud($this->translator->trans('dashboard.crud.language'), 'fa fa-file-audio', Language::class);
        yield MenuItem::linkToCrud($this->translator->trans('dashboard.crud.user'), 'fa fa-user', User::class);
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        return parent::configureUserMenu($user)
            ->setName($user->getUserIdentifier())
            ->displayUserAvatar(false);
    }
}
