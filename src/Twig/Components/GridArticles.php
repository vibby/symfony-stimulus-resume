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

use App\Repository\ArticleRepository;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentToolsTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;

#[AsLiveComponent('GridArticles')]
class GridArticles
{
    use ComponentToolsTrait;
    use DefaultActionTrait;

    private const PER_PAGE = 6;

    #[LiveProp]
    public int $page = 1;

    #[LiveProp(writable: true, onUpdated: 'onSearchUpdated', url: true)]
    public string $search = '';

    public function __construct(
        private readonly ArticleRepository $articles,
    ) {
    }

    #[ExposeInTemplate('per_page')]
    public function getPerPage(): int
    {
        return self::PER_PAGE;
    }

    #[LiveAction]
    public function more(): void
    {
        ++$this->page;
    }

    #[LiveAction]
    public function setSearch(string $search): void
    {
        $this->search = $search;
    }

    public function getViewId(): string
    {
        return dechex(crc32($this->search));
    }

    public function hasMore(): bool
    {
        return $this->articles->count($this->search) > ($this->page * self::PER_PAGE);
    }

    public function getArticles(): array
    {
        return $this->articles->filterPaginated($this->search, $this->page, self::PER_PAGE);
    }

    public function onSearchUpdated($previousValue): void
    {
        if ($previousValue !== $this->search) {
            $this->page = 1;
        }
    }
}
