<?php

namespace App\Controller;

use App\DTO\CategoryDto;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class CategoryController extends AbstractController
{
    public function __construct(
        private CategoryService $service
    )
    {
    }
    
    #[Route('/category', name: 'app_category', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'categories' => $this->service->getAll(),
        ]);
    }

    #[Route('/category/{id}', name: 'app_get_category', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        return $this->json([
            'category' => $this->service->getOne($id),
        ]);
    }

    #[Route('/category', name: 'app_category_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] CategoryDto $dto
    ): JsonResponse
    {
        return $this->json([
            'category' => $this->service->create($dto)
        ], Response::HTTP_CREATED);
    }

    #[Route('/category/{id}', name: 'app_category_edit', methods: ['POST'])]
    public function edit(
        int $id,
        #[MapRequestPayload] CategoryDto $dto
    ): JsonResponse
    {
        return $this->json([
            'category' => $this->service->edit($id, $dto)
        ], Response::HTTP_CREATED);
    }

    #[Route('/category/{id}', name: 'app_category_delete', methods: ['DELETE'])]
    public function delete(
        int $id
    ): JsonResponse
    {
        return $this->json([
            'category' => $this->service->delete($id)
        ]);
    }
}
