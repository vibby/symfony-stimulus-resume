<?php

namespace App\Repository;

use App\Entity\Article;
use Symfony\Contracts\Cache\CacheInterface;

class ArticleLister
{
    const CACHE_KEY = 'articles';
    public function __construct(
        private readonly CacheInterface $cache,
    ) {
    }

    public function list(): array
    {
        return $this->cache->get(
            self::CACHE_KEY,
            function () {
                $articles = [];
                foreach(scandir($this->buildFileRoot()) as $filename) {
                    if (str_starts_with($filename, '.') || !str_ends_with($filename, '.json')) {
                        continue;
                    }
                    $articles[] = Article::jsonDeserialize(file_get_contents($this->buildFileRoot() . $filename));
                }
                return $articles;
            }
        );
    }

    public function reset(): void
    {
        $this->cache->delete(self::CACHE_KEY);
    }

    public static function buildFileRoot(): string
    {
        return __DIR__.'/../../storage/articles/';
    }
}