<?php

namespace App\Controller;

use App\Form\ProjectType;
use App\Repository\ProjectLister;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/projets', name: 'app_projects')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $projectRepository->findAll();
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

    #[Route('/project/{id}/ddit', name: 'app_project_edit')]
    public function edit(string $id, ProjectRepository $projectRepository, ProjectLister $lister, Request $request):
    Response
    {
        $project = $projectRepository->find($id);
        if (null === $project) {
            throw $this->createNotFoundException(sprintf('Projet %s introuvable', $id));
        }
        $form = $this->createForm(ProjectType::class, $project, [
            'action' => $this->generateUrl('app_project_edit', ['id' => $id]),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $projectRepository->save($project);
            $lister->reset();
            $this->addFlash('success', 'Projet mis à jour');

            return $this->redirectToRoute('app_project_edit', ['id' => $id]);
        }

        return $this->render('page/project_edit.html.twig', [
            'project' => $project,
            'form' => $form->createView(),
        ]);
    }
}
