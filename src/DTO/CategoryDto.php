<?php

namespace App\DTO;

class CategoryDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $description = null,
        public ?bool $status = null
    )
    {
    }
}