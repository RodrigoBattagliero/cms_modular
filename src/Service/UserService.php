<?php

namespace App\Service;

use App\DTO\UserDto;
use App\Entity\User;
use App\Mapper\UserMapper;
use Doctrine\ORM\EntityManagerInterface;
use Exception;

class UserService
{

    public function __construct(
        private EntityManagerInterface $em
    )
    {
    }

    public function getAll(): array
    {
        return $this->em->getRepository(User::class)->findAll();
    }

    public function getOne(int $id): User
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['id' => $id]);
        if (!$user) {
            throw new Exception('User not found');
        }
        
        return $user;
    }

    public function create(UserDto $dto): User
    {
        $user = UserMapper::fromCreateDtoToEntity($dto);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function edit(int $id, UserDto $dto): User
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['id' => $id]);
        if (!$user) {
            throw new Exception('User not found');
        }

        $user->setName($dto->name);
        $user->setRol($dto->rol);
        $user->setStatus($dto->status);
        $this->em->persist($user);
        $this->em->flush();

        return $user;
    }

    public function delete(int $id): void
    {
        $user = $this->em->getRepository(User::class)->findOneBy(['id' => $id]);
        if (!$user) {
            throw new Exception('User not found');
        }
        $this->em->remove($user);
        $this->em->flush();
    }
}