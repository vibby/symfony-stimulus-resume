<?php

namespace App\Entity;

class Project
{
    public function __construct(
        public string $id,
        public string $title,
        public string $date,
        public string $link,
        public string $shortDesc,
        public array $tags,
    ){
    }
}
