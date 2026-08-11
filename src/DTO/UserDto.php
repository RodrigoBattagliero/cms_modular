<?php

namespace App\DTO;

class UserDto
{
    public function __construct(
        public ?string $name = null,
        public ?string $email = null,
        public ?int $rol = null,
        public ?bool $status = null
    )
    {
    }
}