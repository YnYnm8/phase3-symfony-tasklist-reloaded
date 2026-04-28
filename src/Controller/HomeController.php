<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;  // ← これが正しい
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\TaskRepository;
use App\Repository\FolderRepository;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(TaskRepository $taskRepository,Request $request,FolderRepository $folderRepository): Response
    // TaskRepository = データベースからTaskを取得するツール
    {
        $user = $this->getUser();
        $status = $request->query->get('status');
        $priority = $request->query->get('priority');
        return $this->render('home/index.html.twig', [

            'tasks' => $taskRepository->findAllOrderedByStatus($user,$status,$priority),
            //  ↑              ↑
            // Twigで使う名前   DBから取得したデータ

            // → DBのtaskテーブルから全件取得
          'folders' => $folderRepository->findBy(['user' => $user]),  // ← 追加
            
        ]);
    }
}
