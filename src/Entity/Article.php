<?php

namespace App\Entity;

class Article implements \JsonSerializable
{
    use JsonDeserializable;

    public function __construct(
        public string $slug,
        public string $title,
        public \DateTime $date,
        public string $intro,
        public string $content,
    ){
    }
}
