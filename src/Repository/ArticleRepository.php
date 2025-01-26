<?php

namespace App\Repository;

use App\Entity\Article;

class ArticleRepository
{
    public function __construct(
        private readonly ArticleLister $lister,
    ) {
    }

    public function findAll(): array
    {
        return $this->lister->list();
    }

    private function filter(string $search): array
    {
        $list = array_filter($this->findAll(), function (Article $article) use ($search): bool {
            return str_contains($article->content, $search);
        });
        usort($list, fn($a, $b) => $a->date < $b->date);

        return $list;
    }

    public function filterPaginated(string $search, int $page, int $perPage): array
    {
        $list = $search !== '' ? $this->filter($search) : $this->findAll();
        usort($list, fn($a, $b) => $a->date < $b->date);

        return array_slice($list, ($page - 1) * $perPage, $perPage);
    }

    public function count(string $search = ''): int
    {
        return count($search === '' ? $this->findAll() : $this->filter($search));
    }

    public function find(string $slug): ?Article
    {
        return array_values(array_filter($this->findAll(), fn(Article $article) => $article->slug === $slug))[0] ?? null;
    }

    public function save(Article $article): void
    {
        $data = json_encode($article);
        file_put_contents($this->buildFilename($article->slug), $data);
    }

    private function buildFilename(string $id): string
    {
        return $this->lister->buildFileRoot().$id.'.json';
    }

}