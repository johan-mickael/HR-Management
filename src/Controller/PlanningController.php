<?php

/**
 * Author: Johan Mickaël
 * Description: This is the controller which handle all requests about the calendar
 */

namespace App\Controller;

use App\Entity\Planning;
use App\Repository\PlanningRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

#[Route('/plannings', name: 'planning_')]
class PlanningController extends AbstractController
{
    private $serializer;

    // Initializing all properties
    public function __construct(Security $security)
    {
        // We are using JSON encoder here to serialize our planning object to a JSON format
        $encoders = [new JsonEncoder()];
        // The object and the  normalizer to normalize our planning object as an array
        $normalizers = [new DateTimeNormalizer(), new ObjectNormalizer()];

        // Creating the serializer instance
        $this->serializer = new Serializer($normalizers, $encoders);

        // Getting the current user instance
        $this->user = $security->getUser();
    }

    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('planning/index.html.twig');
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        // Creating the instance of the planning (event dropped)
        $planning = new Planning();
        $planning->settitle($request->request->get('title'));
        $planning->setStartByDateString($request->request->get('start'));
        $planning->setEnd();
        $planning->setColor($request->request->get('color'));
        $planning->setAllDay($request->request->get('allDay'));
        $planning->setTextColor($request->request->get('textColor'));

        // Saving the planning into the database
        $entityManager->persist($planning);
        $entityManager->flush();

        // Sending a 202 response with a message
        return new JsonResponse($serializer->serialize($planning, 'json', ['groups' => ['calendar']]));
    }

    #[Route('/edit', name: 'edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SerializerInterface $serializer): Response
    {
        // Find the current event planning into the database to edit it later
        $planning = $entityManager->getRepository(Planning::class)->find($request->request->get('id'));
        $planning->settitle($request->request->get('title'));
        $planning->setStartByDateString($request->request->get('start'));
        $planning->setEndByDateString($request->request->get('end'));
        $planning->setColor($request->request->get('color'));
        $planning->setAllDay($request->request->get('allDay'));
        $planning->setTextColor($request->request->get('textColor'));

        // // Saving the planning into the database
        $entityManager->flush();

        // Sending a 202 response with a message
        return new JsonResponse($serializer->serialize($planning, 'json', ['groups' => ['calendar']]));
    }

    #[Route('/json', name: 'data')]
    public function getJson(PlanningRepository $planningRepository, SerializerInterface $serializer): JsonResponse
    {
        // Getting all plannings stored in the database
        $planning = $planningRepository->findAll();
        // Serializing the data and send it as a Json response
        return new JsonResponse($serializer->serialize($planning, 'json', ['groups' => ['calendar']]));
    }


    #[Route('/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, EntityManagerInterface $entityManager): Response
    {
        $planning = $entityManager->getRepository(Planning::class)->find($request->request->get('id'));
        $entityManager->remove($planning);
        $entityManager->flush();

        return new Response('Supprimé');
    }
}
