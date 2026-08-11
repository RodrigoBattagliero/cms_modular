<?php

namespace App\Service;

use App\DTO\CategoryDto;
use App\Entity\Category;
use App\Mapper\CategoryMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class CategoryService
{

    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    public function getAll(): array
    {
        return $this->em->getRepository(Category::class)->findAll();
    }

    public function getOne(int $id): Category
    {
        $category = $this->em->getRepository(Category::class)->findOneBy(['id' => $id]);
        if (!$category) {
            throw new Exception('Category not found');
        }
        return $category;
    }

    public function create(CategoryDto $dto): Category
    {
        $category = CategoryMapper::fromCreateDtoToEntity($dto);
        $this->em->persist($category);
        $this->em->flush();

        return $category;
    }

    public function edit(int $id, CategoryDto $dto): Category
    {
        $category = $this->em->getRepository(Category::class)->findOneBy(['id' => $id]);
        if (!$category) {
            throw new Exception('Category not found');
        }

        $category->setName($dto->name);
        $category->setStatus($dto->status);
        $category->setDescription($dto->description);
        $this->em->persist($category);
        $this->em->flush();

        return $category;
    }

    public function delete(int $id): void
    {
        $category = $this->em->getRepository(Category::class)->findOneBy(['id' => $id]);
        if (!$category) {
            throw new Exception('Category not found');
        }
        $this->em->remove($category);
        $this->em->flush();
    }
}