<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('slug',
                null,
                [
                ]
            )
            ->add(  'title',
                null,
                [
                ]
            )
            ->add(  'date',
                DateType::class,
                [
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                ]
            )
            ->add(  'intro',
                TextareaType::class,
                [
                ]
            )
            ->add(  'content',
                TextareaType::class,
                [
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
            'empty_data' => function (FormInterface $form) {
                return new Article(
                    'slug',
                    'title',
                    new \DateTime(),
                    'intro',
                    'content',
                );
            },
        ]);
    }
}
