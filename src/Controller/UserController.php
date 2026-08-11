<?php

namespace App\Controller;

use App\DTO\UserDto;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class UserController extends AbstractController
{
    public function __construct(
        private UserService $service
    )
    {
    }
    
    #[Route('/user', name: 'app_user', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'users' => $this->service->getAll(),
        ]);
    }

    #[Route('/user/{id}', name: 'app_get_user', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        return $this->json([
            'user' => $this->service->getOne($id),
        ]);
    }

    #[Route('/user', name: 'app_user_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] UserDto $dto
    ): JsonResponse
    {
        return $this->json([
            'user' => $this->service->create($dto)
        ], Response::HTTP_CREATED);
    }

    #[Route('/user/{id}', name: 'app_user_edit', methods: ['POST'])]
    public function edit(
        int $id,
        #[MapRequestPayload] UserDto $dto
    ): JsonResponse
    {
        return $this->json([
            'user' => $this->service->edit($id, $dto)
        ], Response::HTTP_CREATED);
    }

    #[Route('/user/{id}', name: 'app_user_delete', methods: ['DELETE'])]
    public function delete(
        int $id
    ): JsonResponse
    {
        return $this->json([
            'user' => $this->service->delete($id)
        ]);
    }
}
