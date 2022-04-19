<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function index(Request $request, GameRepository $gr, CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        $word=$request->query->get('search');
        $games = $gr->findBySearch($word);
        
        return $this->render('search/index.html.twig', [
            'games' => $games,
            'result' => $word,
            'categories' => $categories
        ]);
    }
}
