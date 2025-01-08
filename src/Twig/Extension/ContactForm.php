<?php

namespace App\Twig\Extension;

use App\Form\ContactType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\Routing\RouterInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class ContactForm extends AbstractExtension
{
    public function __construct(
        private readonly FormFactoryInterface $formFactory,
        private readonly RouterInterface $router,
    ) {
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('contactForm', [$this, 'contactForm']),
        ];
    }

    public function contactForm(): FormView
    {
        return $this->formFactory->create(ContactType::class, null, [
            'action' => $this->router->generate('app_contact'),
        ])->createView();
    }
}