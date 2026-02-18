<?php

namespace App\Controller;

use App\Entity\Project;
use App\Entity\Task;
use App\Form\TaskType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TaskController extends AbstractController
{
    public function __construct(
        private EntityManagerInterface $manager,
    ) {}

    #[Route('/project/{project}/task/{id}', name: 'app_task', requirements: ['project' => '\d+', 'id' => '\d+'], methods: ['GET', 'POST'])]
    #[Route('/project/{project}/task/new', name: 'app_task_new', requirements: ['project' => '\d+'], methods: ['GET', 'POST'])]
    public function edit(?Task $task, Project $project, Request $request): Response
    {
        if (!$task) {
            $task = new Task();
            $task->setProject($project);
        } elseif ($task->getProject()->getId() !== $project->getId()) {
            throw $this->createNotFoundException('La tâche ne correspond pas au projet.');
        }

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->manager->persist($task);
            $this->manager->flush();

            return $this->redirectToRoute('app_project', ['id' => $project->getId()]);
        }

        return $this->render('task/edit.html.twig', [
            'form' => $form,
            'task' => $task,
            'new' => $task->getId() === null,
        ]);
    }
}
