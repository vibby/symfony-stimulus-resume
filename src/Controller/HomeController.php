<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ContactType;
use App\Repository\ProjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(ProjectRepository $projectRepository): Response
    {
        $contactForm = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('app_contact'),
        ]);
        $projects = $projectRepository->filterPaginated([], 1, 6);

        return $this->render('page/home.html.twig', [
            'controller_name' => 'HomeController',
            'contact_form' => $contactForm,
            'projects' => $projects,
            'tags' => array_unique(array_reduce(
                $projects,
                function (array $stack, Project $project) {
                    return array_merge($stack, $project->tags);
                },
                []
            )),
        ]);
    }
}
