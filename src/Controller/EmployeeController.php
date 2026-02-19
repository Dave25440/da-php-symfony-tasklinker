<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Form\EmployeeType;
use App\Repository\EmployeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class EmployeeController extends AbstractController
{
    public function __construct(
        private EmployeeRepository $employeeRepository,
        private EntityManagerInterface $manager,
    ) {}

    #[Route('/employee', name: 'app_employee', methods: ['GET'])]
    public function index(): Response
    {
        $employees = $this->employeeRepository->findAll();

        return $this->render('employee/index.html.twig', [
            'employees' => $employees,
        ]);
    }

    #[Route('/employee/{id}', name: 'app_employee_edit', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(?Employee $employee, Request $request): Response
    {
        if (!$employee) {
            throw $this->createNotFoundException('Employé introuvable.');
        }

        $form = $this->createForm(EmployeeType::class, $employee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->flush();

            return $this->redirectToRoute('app_employee');
        }

        return $this->render('employee/edit.html.twig', [
            'form' => $form,
            'employee' => $employee,
        ]);
    }
}
