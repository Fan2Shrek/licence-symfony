<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'projects' => $projectRepository->findBy([], ['id' => 'DESC'])
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
