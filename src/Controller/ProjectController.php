<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/projets', name: 'app_projects')]
    public function index(ProjectRepository $projectRepository): Response
    {
        return $this->render('page/projects.html.twig', [
            'controller_name' => 'HomeController',
            'tags' => $projectRepository->findAllTags(),
        ]);
    }
}
