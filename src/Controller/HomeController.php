<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\GameRepository;
use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/displaySubscription', name: 'app_display_subscription')]
    public function displaySubscripton( SubscriptionRepository $subrepo ) : Response
    {
        $subscriptions = $subrepo->findAll();
        // dd( $subscriptions );

        return $this->render('home/displaySubscription.html.twig', [
            'subscriptions' => $subscriptions
        ]);
    }

    #[Route('/displayGame', name: 'app_display_game')]
    public function displayGame( GameRepository $gameRepository, CategoryRepository $categoryRepository ) : Response
    {
        $games = $gameRepository->findAll();
        $cate = $categoryRepository->findAll();
        // dd($games);
        return $this->render('home/displayGame.html.twig', [
            'games' => $games,
            'categories' => $cate
        ]);
    }


    #[Route('/displayGame/{id}', name: 'app_onegame', methods: ['GET'])]
    public function displayOneGame($id, GameRepository $gameRepository ) : Response
    {
        $game = $gameRepository->find($id);

        return $this->render('home/oneGame.html.twig', [
            'game' => $game
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', [
            
        ]);
    }

    #[Route('/blog', name: 'app_blog')]
    public function blog(): Response
    {
        return $this->render('home/blog.html.twig', [
            
        ]);
    }
}
