<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ArticleController extends AbstractController
{
    #[Route('/articles', name: 'app_articles')]
    public function index(): Response
    {
        return $this->render('page/articles.html.twig', [
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
