<?php

namespace App\Repository;

use App\Entity\Project;
use Symfony\Contracts\Cache\CacheInterface;

class ProjectLister
{
    const CACHE_KEY = 'projects';
    public function __construct(
        private readonly CacheInterface $cache,
    ) {
    }

    public function list(): array
    {
        return $this->cache->get(
            self::CACHE_KEY,
            function () {
                $projects = [];
                foreach(scandir($this->buildFileRoot()) as $filename) {
                    if (str_starts_with($filename, '.') || !str_ends_with($filename, '.json')) {
                        continue;
                    }
                    $projects[] = Project::jsonDeserialize(file_get_contents($this->buildFileRoot() . $filename));
                }
                return $projects;
            }
        );
    }

    public function reset(): void
    {
        $this->cache->delete(self::CACHE_KEY);
    }

    public static function buildFileRoot(): string
    {
        return __DIR__.'/../../storage/projects/';
    }
}