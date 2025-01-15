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
    public function index(): Response
    {
        return $this->render('page/projects.html.twig', [
        ]);
    }
}
