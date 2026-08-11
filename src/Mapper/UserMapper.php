<?php

namespace App\Mapper;

use App\DTO\UserDto;
use App\Entity\User;

class UserMapper
{
    public static function fromCreateDtoToEntity(UserDto $dto): User
    {
        $user = new User();
        return $user
            ->setName($dto->name)
            ->setEmail($dto->email)
            ->setRol($dto->rol)
            ->setStatus($dto->status);
    }
}