<?php

namespace App\Controller;

use App\Entity\Video;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/videos')]
class VideoController extends AbstractController
{
    public function __construct(private readonly EntityManagerInterface $entityManager)
    {
    }

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        $videos = $this->entityManager->getRepository(Video::class)->findAll();
        return $this->json($videos, Response::HTTP_OK, [], ['groups' => 'video:read']);
    }

    #[Route('', methods: ['POST'])]
    public function create(Request $request): JsonResponse
    {
        $data = $request->toArray();

        $video = new Video();
        $video->setTitle($data['title']);
        $video->setDescription($data['description'] ?? null);
        $video->setUrl($data['url']);
        $video->setCreatedAt(new \DateTime());

        $this->entityManager->persist($video);
        $this->entityManager->flush();

        return $this->json($video, Response::HTTP_CREATED, [], ['groups' => 'video:read']);
    }

    #[Route('/{id}', methods: ['GET'])]
    public function show(int $id): JsonResponse
    {
        $video = $this->entityManager->getRepository(Video::class)->find($id);

        if (!$video) {
            throw new NotFoundHttpException('Video not found');
        }

        return $this->json($video, Response::HTTP_OK, [], ['groups' => 'video:read']);
    }

    #[Route('/{id}', methods: ['PATCH'])]
    public function update(Request $request, int $id): JsonResponse
    {
        $video = $this->entityManager->getRepository(Video::class)->find($id);

        if (!$video) {
            throw new NotFoundHttpException('Video not found');
        }

        $data = $request->toArray();

        $video->setTitle($data['title'] ?? $video->getTitle());
        $video->setDescription($data['description'] ?? $video->getDescription());
        $video->setUrl($data['url'] ?? $video->getUrl());

        $this->entityManager->flush();

        return $this->json($video, Response::HTTP_OK, [], ['groups' => 'video:read']);
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function delete(int $id): JsonResponse
    {
        $video = $this->entityManager->getRepository(Video::class)->find($id);

        if (!$video) {
            throw new NotFoundHttpException('Video not found');
        }

        $this->entityManager->remove($video);
        $this->entityManager->flush();

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
