<?php

namespace App\Controller;

use App\Entity\Project;
use App\Repository\ProjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectController extends AbstractController
{
    public function __construct(
        private ProjectRepository $projectRepository,
        private EntityManagerInterface $manager,
    ) {}

    #[Route('/', name: 'app_home', methods: ['GET'])]
    public function index(): Response
    {
        $projects = $this->projectRepository->findActive();

        return $this->render('project/index.html.twig', [
            'controller_name' => 'ProjectController',
            'projects' => $projects,
        ]);
    }

    #[Route('/project/{id}/archive', name: 'app_project_archive', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function archive(?Project $project): Response
    {
        if (!$project) {
            return $this->redirectToRoute('app_home');
        }

        $project->setArchive(false);
        $this->manager->flush();

        return $this->redirectToRoute('app_home');
    }
}
