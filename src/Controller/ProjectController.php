<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\ArticleRepository;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/projets', name: 'app_projects')]
    public function index(): Response
    {
        return $this->render('page/projects.html.twig', [
        ]);
    }

    #[Route('/project/{id}', name: 'app_project')]
    public function show(string $id, ProjectRepository $projectRepository): Response
    {
        $project = $projectRepository->find($id);
        if (null === $project) {
            throw $this->createNotFoundException(sprintf('Projet %s introuvable', $id));
        }

        return $this->render('page/project.html.twig', [
            'project' => $project,
        ]);
    }
}
