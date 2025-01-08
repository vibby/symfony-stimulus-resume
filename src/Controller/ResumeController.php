<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ResumeController extends AbstractController
{
    #[Route('/resume', name: 'app_resume')]
    public function index(): Response
    {
        return $this->render('page/resume.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
