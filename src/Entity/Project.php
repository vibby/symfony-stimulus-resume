<?php

namespace App\Entity;

class Project implements \JsonSerializable
{
    use JsonDeserializable;

    public function __construct(
        public string $id,
        public string $title,
        public string $date,
        public string $shortDesc,
        public array $tags,
        public ?string $link = null,
        public ?string $clientName = null,
        public ?string $clientLink = null,
        public ?string $context = null,
    ){
    }

    public function getTags(): array
    {
        return array_map(fn($tag) => mb_strtolower($tag), $this->tags);
    }

    public function getTagsAsKeys(): array
    {
        return array_fill_keys(array_map(fn($tag) => mb_strtolower($tag), $this->tags), null);
    }
}
