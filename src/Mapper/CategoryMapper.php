<?php

namespace App\Mapper;

use App\DTO\CategoryDto;
use App\Entity\Category;

class CategoryMapper
{
    public static function fromCreateDtoToEntity(CategoryDto $dto): Category
    {
        $category = new Category();
        return $category
            ->setName($dto->name)
            ->setDescription($dto->description)
            ->setStatus($dto->status);
    }
}