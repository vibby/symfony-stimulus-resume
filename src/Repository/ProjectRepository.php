<?php

namespace App\Repository;

use App\Entity\Project;

class ProjectRepository
{
    public function __construct(
        private readonly ProjectLister $lister,
    ) {
    }

    public function findAll(): array
    {
        return $this->lister->list();
    }

    private function filter(array $tags): array
    {
        $list = array_filter(
            $this->findAll(),
            function (Project $project) use ($tags): bool {
                return count(array_intersect($tags, $project->getTags())) === count($tags);
            }
        );
        usort($list, fn($a, $b) => $a->date < $b->date);

        return $list;
    }

    public function filterPaginated(array $tags, int $page, int $perPage): array
    {
        $list = $tags !== [] ? $this->filter($tags) : $this->findAll();
        usort($list, fn($a, $b) => $a->date < $b->date);

        return array_slice($list, ($page - 1) * $perPage, $perPage);
    }

    public function findAvailableTags(array $otherTags): array
    {
        $list = array_unique(array_reduce(
            $this->findAll(),
            function (array $stack, Project $project) {
                return array_merge($stack, $project->getTags());
            },
            []
        ));
        sort($list);
        $used = array_reduce(
            $this->filter($otherTags),
            function (array $stack, Project $project) {
                return array_merge($stack, $project->getTags());
            },
            []
        );

        return array_merge(array_fill_keys($list, 0), array_count_values($used));
    }

    public function count(array $tags = []): int
    {
        return count($tags === [] ? $this->findAll() : $this->filter($tags));
    }

    public function find(string $id)
    {
        return array_values(array_filter($this->findAll(), fn(Project $project) => $project->id === $id))[0] ?? null;
    }

    public function save(Project $project): void
    {
        $data = json_encode($project);
        file_put_contents($this->buildFilename($project->id), $data);
    }

    private function buildFilename(string $id): string
    {
        return $this->lister->buildFileRoot().$id.'.json';
    }
}