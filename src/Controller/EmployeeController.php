<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/employee')]
class EmployeeController extends AbstractController
{
    private $em; //define an entity manager variable 
    private $repo; //define a repository variable 

    public function __construct(EmployeeRepository $repo, EntityManagerInterface $em)
    {

        $this->repo = $repo; //get the repository
        $this->em = $em; //set the entity manager

    }
    #[Route('/', name: 'app_employee_index', methods: ['GET'])]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('employee/index.html.twig', [
            'employees' =>  $this->repo->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_employee_new', methods: ['GET', 'POST'])]
    public function new(Request $request): Response
    {
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('employee_photo')->getData();
            // get and generate the new file name
            $fichier = md5(uniqid()) . '.' . $file->guessExtension();
            // copy the file in the folder directory
            $file->move(
                $this->getParameter('employees_avatar'),
                $fichier
            );
            // add the file in the form data to be save
            $employee->setEmployeePhoto($fichier);
            $this->repo->add($employee);

            // show success message
            $this->addFlash('success', 'Employé(e) enregistré avec succès');
            return $this->redirectToRoute('app_employee_index');
        }

        return $this->renderForm('employee/new.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_show', methods: ['GET'])]
    public function show(Employee $employee): Response
    {
        return $this->render('employee/show.html.twig', [
            'employee' => $employee,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_employee_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Employee $employee): Response
    {
        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $form->get('employee_photo')->getData();
            // get and generate the new file name
            $fichier = md5(uniqid()) . '.' . $file->guessExtension();
            // copy the file in the folder directory
            $file->move(
                $this->getParameter('employees_avatar'),
                $fichier
            );
            // add the file in the form data to be save
            $employee->setEmployeePhoto($fichier);
            $this->repo->add($employee);
            // show success message
            $this->addFlash('success', 'Employé(e) actulisé avec succès');
            return $this->redirectToRoute('app_employee_index');
        }

        return $this->renderForm('employee/edit.html.twig', [
            'employee' => $employee,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_employee_delete', methods: ['POST'])]
    public function delete(Request $request, Employee $employee): Response
    {
        if ($this->isCsrfTokenValid('delete' . $employee->getId(), $request->request->get('_token'))) {
            $this->repo->remove($employee);
        }

        return $this->redirectToRoute('app_employee_index', [], Response::HTTP_SEE_OTHER);
    }
}
