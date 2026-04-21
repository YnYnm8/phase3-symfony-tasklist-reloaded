<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PriorityController extends AbstractController
{
    #[Route('/priority', name: 'app_priority')]
    public function index(): Response
    {
        return $this->render('priority/priority.html.twig', [
            'controller_name' => 'PriorityController',
        ]);
    }
}
