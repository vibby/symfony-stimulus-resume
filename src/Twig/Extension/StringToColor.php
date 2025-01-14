<?php

namespace App\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class StringToColor extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('stringToColor', [$this, 'stringToColor']),
        ];
    }

    public function stringToColor(string $str): string
    {
        $code = dechex(crc32($str));

        return substr($code, 0, 6);
    }
}