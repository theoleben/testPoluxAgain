<?php

namespace App\Controller;

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
    public function displayGame( GameRepository $gameRepository ) : Response
    {
        $games = $gameRepository->findAll();

        return $this->render('home/displayGame.html.twig', [
            'games' => $games
        ]);
    }

    #[Route('/displayGame/{id}', name: 'app_onegame', methods: ['GET'])]
    public function displayOneGame($id, GameRepository $gameRepository ) : Response
    {
        $game = $gameRepository->find($id);
        $games = $gameRepository->findAll();

        return $this->render('home/oneGame.html.twig', [
            'game' => $game,
            'games' => $games
        ]);
    }

    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('home/faq.html.twig', [
        ]);
    }

}
