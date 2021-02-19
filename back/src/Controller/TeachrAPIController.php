<?php

namespace App\Controller;

use App\Repository\TeachrRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/teachr")
 */
class TeachrAPIController extends AbstractController
{

    /**
     * @param mixed $data
     *
     * Override de la fonction json pour renvoyer une réponse formatée
     */
    protected function json($data, int $status = 200, array $headers = [], array $context = []): JsonResponse
    {
        return parent::json(
            [
                "status" => $status,
                "data" => (is_array($data) ? ($data["data"] ?? null) : $data),
                "message" => (is_array($data) ? ($data["message"] ?? "Succès") : "Succès")
            ],
            $status,
            $headers,
            $context
        );
    }

    /**
     * @Route("", name="api.teachr.index")
     */
    public function index(TeachrRepository $repository): JsonResponse
    {
        return $this->json([
            "data" => $repository->findAll()
        ]);
    }
}
