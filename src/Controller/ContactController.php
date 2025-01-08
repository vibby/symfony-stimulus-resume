<?php

namespace App\Controller;

use App\Form\ContactType;
use App\Repository\ContactRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\UX\Turbo\TurboBundle;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, ContactRepository $repository): Response
    {
        $form = $this->createForm(ContactType::class, null, [
            'action' => $this->generateUrl('app_contact'),
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contact = $form->getData();
            $repository->store($contact);

            if (TurboBundle::STREAM_FORMAT === $request->getPreferredFormat()) {
                $request->setRequestFormat(TurboBundle::STREAM_FORMAT);
                return $this->renderBlock('page/contact.html.twig', 'success_stream', ['contact' => $contact]);
            }

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('page/contact.html.twig', [
            'controller_name' => 'ContactController',
            'contact_form' => $form,
        ]);
    }
}
