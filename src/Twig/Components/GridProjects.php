<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Twig\Components;

use App\Repository\ProjectRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent('GridProjects')]
class GridProjects
{
    use ComponentToolsTrait;
    use DefaultActionTrait;

    private const PER_PAGE = 6;

    #[LiveProp]
    public int $page = 1;

    #[LiveProp(writable: true, onUpdated: 'onTagsUpdated', url: true)]
    public array $tags = [];

    public function __construct(
        private readonly ProjectRepository $projects,
    ) {
    }

    #[ExposeInTemplate('per_page')]
    public function getPerPage(): int
    {
        return self::PER_PAGE;
    }

    public function getAvailableTags(): array
    {
        return $this->projects->findAvailableTags($this->tags);
    }

    #[LiveAction]
    public function more(): void
    {
        ++$this->page;
    }

    #[LiveAction]
    public function setTags(array $tags): void
    {
        $this->tags = $tags;
    }

    public function hasMore(): bool
    {
        return $this->projects->count($this->tags) > ($this->page * self::PER_PAGE);
    }

    public function getProjects(): array
    {
        return $this->projects->filterPaginated($this->tags, $this->page, self::PER_PAGE);
    }

    public function getViewId(): string
    {
        return dechex(crc32(implode('', $this->tags)));
    }

    public function onTagsUpdated($previousValue): void
    {
        if ($previousValue !== $this->tags) {
            $this->page = 1;
        }
    }
}
