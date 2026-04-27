<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Task;
use App\Form\TaskType;
// use App\Repository\TaskRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/task')]
final class TaskController extends AbstractController
{
    // #[Route(name: 'app_task_index', methods: ['GET'])]
    // public function index(TaskRepository $taskRepository): Response
    // {
    //     return $this->render('task/index.html.twig', [
    //         'tasks' => $taskRepository->findAll(),
    //     ]);
    // }

    #[Route('/new', name: 'app_task_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $task = new Task();
        $form = $this->createForm(TaskType::class, $task);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $task->setUser($this->getUser());
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('app_home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('task/new.html.twig', [
            'task' => $task,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/status', name: 'app_task_status', methods: ['POST'])]
    public function updateStatus(Task $task, EntityManagerInterface $em): Response
    {
        if ($task->getStatus() === Task::STATUS_PENDING) {
            $task->setStatus(Task::STATUS_COMPLETED);
        } elseif ($task->getStatus() === Task::STATUS_COMPLETED) {
            $task->setStatus(Task::STATUS_ARCHIVED);
        } else {
            $task->setStatus(Task::STATUS_PENDING);
        }

        $em->flush();

        return $this->redirectToRoute('app_home');
    }

 #[Route('/{id}/pin', name: 'app_task_pin', methods: ['POST'])]
 public function togglePinned(Task $task,EntityManagerInterface $em):Response
 {
// trueならfalse、falseならtrueにする
    $task->setIsPinned(!$task->isPinned());
    $em->flush();
    return $this->redirectToRoute('app_home');
 }


    // #[Route('/{id}', name: 'app_task_show', methods: ['GET'])]
    // public function show(Task $task): Response
    // {
    //     return $this->render('task/show.html.twig', [
    //         'task' => $task,
    //     ]);
    // }

    // #[Route('/{id}/edit', name: 'app_task_edit', methods: ['GET', 'POST'])]
    // public function edit(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    // {
    //     $form = $this->createForm(TaskType::class, $task);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $entityManager->flush();

    //         return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->render('task/edit.html.twig', [
    //         'task' => $task,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_task_delete', methods: ['POST'])]
    // public function delete(Request $request, Task $task, EntityManagerInterface $entityManager): Response
    // {
    //     if ($this->isCsrfTokenValid('delete'.$task->getId(), $request->getPayload()->getString('_token'))) {
    //         $entityManager->remove($task);
    //         $entityManager->flush();
    //     }

    //     return $this->redirectToRoute('app_task_index', [], Response::HTTP_SEE_OTHER);
    // }
}
