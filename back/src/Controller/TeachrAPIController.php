<?php

namespace App\Controller;

use App\Entity\Statistics;
use App\Entity\Teachr;
use App\Form\TeachrFormType;
use App\Repository\StatisticsRepository;
use App\Repository\TeachrRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
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
     * @Route("", name="api.teachr.index", methods={"GET", "POST"})
     */
    public function index(
        TeachrRepository $teachrRepository,
        StatisticsRepository $statsRepository,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {

        $teachr = new Teachr();
        $form = $this->createForm(TeachrFormType::class, $teachr);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Teachr $teachr
             */
            $teachr = $form->getData();



            // Récupérer l'objet stats de la table statistiques
            $stats = $statsRepository->findOneBy([]);

            // Si l'objet n'existe pas, il faudra le créer
            if(null == $stats) {
                $stats = (new Statistics())
                    ->setNumTeachrs(count($teachrRepository->findAll()) + 1);
            } else {
                $stats->setNumTeachrs($stats->getNumTeachrs() + 1);
            }

            $em->persist($stats);
            $em->persist($teachr);
            $em->flush();

            return $this->json([
                "data" => $teachr
            ]);
        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $errors = [];
            foreach($form->getErrors(true) as $error) {
                $errors[$error->getOrigin()->getName()] = $error->getMessage();
            }

            // réponse invalide
            return $this->json([
                "data" => null,
                "message" => $errors
            ], 400);
        }

        return $this->json([
            "data" => $teachrRepository->findAll()
        ]);
    }

    /**
     * @Route("/{id<\d+>}", methods={"PUT"}, name="api.teachr.edit")
     */
    public function edit(
        int $id,
        TeachrRepository $teachrRepository,
        Request $request,
        EntityManagerInterface $em
    ): JsonResponse {

        $teachr = $teachrRepository->findOneBy(['id' => $id]);
        if(null == $teachr) {
            // réponse invalide
            return $this->json([
                "data" => null,
                "message" => "Objet non trouvé"
            ], 404);
        }

        $form = $this->createForm(TeachrFormType::class, $teachr, [
            'method' => 'PUT',
        ]);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Teachr $teachr
             */
            $teachr = $form->getData();


            $em->persist($teachr);
            $em->flush();

        } elseif ($form->isSubmitted() && !$form->isValid()) {
            $errors = [];
            foreach($form->getErrors(true) as $error) {
                $errors[$error->getOrigin()->getName()] = $error->getMessage();
            }

            // réponse invalide
            return $this->json([
                "data" => null,
                "message" => $errors
            ], 400);
        }

        return $this->json([
            "data" => $teachr
        ]);
    }
}
