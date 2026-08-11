<?php

namespace App\DTO;

class ArticleDto
{
    public function __construct(
        public ?string $title = null,
        public ?string $content = null,
        public ?bool $status = null,
        public ?int $author_id = null,
        public ?array $categories = null
    )
    {
    }
}