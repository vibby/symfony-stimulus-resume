<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',
                null,
                [
                    'required' => true,
                    'label' => 'Now',
                    'attr' => [
                        'placeholder' => 'Nom',
                    ]
                ]
            )
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Email',
                'attr' => [
                    'placeholder' => 'Email',
                ]
            ])
            ->add('subject', ChoiceType::class, [
                'required' => true,
                'label' => 'Sujet',
                'choices' => [
                    'Sujet' => null,
                    'Appli web complète' => 'appli',
                    'Intégration Web' => 'integration',
                    'Symfony / api-platform' => 'symfony',
                    'Autre backend' => 'backend',
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => 'Message',
                'required' => true,
                'attr' => [
                    'placeholder' => 'Votre message',
                    'cols' => '14',
                    'rows' => '6',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
