<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\DependencyInjection\Attribute\AutowireCallable;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(
        #[AutowireCallable(service: ProjectRepository::class, method: 'findBy')] \Closure $project
    ): Response
    {
        return $this->render('home/index.html.twig', [
            'projects' => $project([], ['id' => 'DESC'])
        ]);
    }

    #[Route('/projet/{name}', name: 'app_project')]
    public function project(Project $project): Response
    {
        return $this->render('home/view.html.twig', [
            'project' => $project
        ]);
    }
}
