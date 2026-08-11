<?php

namespace App\Controller;

use App\DTO\ArticleDto;
use App\Service\ArticleService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Response;

final class ArticleController extends AbstractController
{
    public function __construct(
        private ArticleService $service
    )
    {
    }
    
    #[Route('/article', name: 'app_article', methods: ['GET'])]
    public function index(): JsonResponse
    {
        return $this->json([
            'articles' => $this->service->getAll(),
        ]);
    }

    #[Route('/article/{id}', name: 'app_get_article', methods: ['GET'])]
    public function get(int $id): JsonResponse
    {
        return $this->json([
            'article' => $this->service->getOne($id),
        ]);
    }

    #[Route('/article', name: 'app_article_create', methods: ['POST'])]
    public function create(
        #[MapRequestPayload] ArticleDto $dto
    ): JsonResponse
    {
        return $this->json([
            'article' => $this->service->create($dto)
        ], Response::HTTP_CREATED);
    }

    #[Route('/article/{id}', name: 'app_article_edit', methods: ['POST'])]
    public function edit(
        int $id,
        #[MapRequestPayload] ArticleDto $dto
    ): JsonResponse
    {
        return $this->json([
            'article' => $this->service->edit($id, $dto)
        ], Response::HTTP_CREATED);
    }

    #[Route('/article/{id}', name: 'app_article_delete', methods: ['DELETE'])]
    public function delete(
        int $id
    ): JsonResponse
    {
        return $this->json([
            'article' => $this->service->delete($id)
        ]);
    }
}
