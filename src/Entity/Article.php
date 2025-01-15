<?php

namespace App\Entity;

class Article
{
    public function __construct(
        public string $slug,
        public string $title,
        public \DateTime $date,
        public string $intro,
        public string $content,
    ){
    }
}
