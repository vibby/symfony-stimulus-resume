<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        $contactForm = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('app_contact'),
        ]);

        return $this->render('page/home.html.twig', [
            'controller_name' => 'HomeController',
            'contact_form' => $contactForm,
        ]);
    }
}
