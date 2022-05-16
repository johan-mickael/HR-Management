<?php

namespace App\Controller;

use App\Repository\EmployeeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourriersController extends AbstractController
{
    #[Route('/courriers', name: 'app_courriers')]
    public function index(EmployeeRepository $employeeRepository): Response
    {
        return $this->render('courriers/index.html.twig', [
            'controller_name' => 'CourriersController',
            'employees' => $employeeRepository->findAll(),
        ]);
    }

    #[Route('/courriers/read', name: 'app_courriers_read')]
    public function read(): Response
    {
        return $this->render('courriers/read.html.twig');
    }
}
