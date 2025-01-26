<?php

namespace App\Controller;

use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use App\Repository\ArticleLister;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(ArticleRepository $articleRepository): Response
    {
        foreach ($articleRepository->findAll() as $article) {
            $articleRepository->save($article);
        }
        return $this->render('page/articles.html.twig', [
        ]);
    }

    #[Route('/articles/rreate', name: 'app_article_create')]
    public function create(ArticleRepository $articleRepository, ArticleLister $lister, Request $request):
    Response
    {
        $form = $this->createForm(ArticleType::class, null, [
            'action' => $this->generateUrl('app_article_create'),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $article = $form->getData();
            $articleRepository->save($article);
            $lister->reset();
            $this->addFlash('success', 'Article créé');

            return $this->redirectToRoute('app_article_edit', ['slug' => $article->slug]);
        }

        return $this->render('page/article_create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/articles/{slug}/ddit', name: 'app_article_edit')]
    public function edit(string $slug, ArticleRepository $articleRepository, ArticleLister $lister, Request $request):
    Response
    {
        $article = $articleRepository->find($slug);
        if (null === $article) {
            throw $this->createNotFoundException(sprintf('Projet %s introuvable', $slug));
        }
        $form = $this->createForm(ArticleType::class, $article, [
            'action' => $this->generateUrl('app_article_edit', ['slug' => $slug]),
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $articleRepository->save($article);
            $lister->reset();
            $this->addFlash('success', 'Article mis à jour');

            return $this->redirectToRoute('app_article_edit', ['slug' => $slug]);
        }

        return $this->render('page/article_edit.html.twig', [
            'article' => $article,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/articles/{slug}', name: 'app_article')]
    public function show(string $slug, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($slug);
        if (null === $article) {
            throw $this->createNotFoundException(sprintf('Article %s introuvable', $slug));
        }

        return $this->render('page/article.html.twig', [
            'article' => $article,
        ]);
    }
}
