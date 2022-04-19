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
        $games = $gameRepository->findAll();

        return $this->render('home/oneGame.html.twig', [
            'game' => $game,
            'games' => $games
        ]);
    }

    #[Route('/BestSeller', name: 'app_bestSeller')]
    public function displayBestSeller(GameRepository $gameRepository): Response
    {
        $games = $gameRepository->findAll();
        // $bestGames = $gameRepository->findBy(array(), array('title' => 'ASC'), 5, null);
        $gamesPrice = $gameRepository->findByGames(5);

        return $this->render('home/bestSeller.html.twig', [
            'games' => $games,
            // 'bestGames' => $bestGames,
            'gamesPrice' => $gamesPrice
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('home/contact.html.twig', []);
    }

    #[Route('/blog', name: 'app_blog')]
    public function blog(): Response
    {
        return $this->render('home/blog.html.twig', []);
    }
    
    #[Route('/cgv', name: 'app_cgv')]
    public function displaycgv(): Response
    {
        return $this->render('home/cgv.html.twig',[]);
    }

    #[Route('/mentions_legales', name: 'app_mentions_legales')]
    public function displaymentions_legales(): Response
    {
        return $this->render('home/mentions_legales.html.twig',[]);
    }
    
    #[Route('/faq', name: 'app_faq')]
    public function faq(): Response
    {
        return $this->render('home/faq.html.twig', []);
    }
    
    #[Route('/pdc', name: 'app_pdc')]
    public function displaypdc(): Response
    {
        return $this->render('home/pdc.html.twig',[]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function displaycontact(): Response
    {
        return $this->render('home/contact.html.twig',[]);
    }

    #[Route('/recrutement', name: 'app_recrutement')]
    public function displayrecrutement(): Response
    {
        return $this->render('home/recrutement.html.twig',[]);
    }

    #[Route('/label_qualite', name: 'app_label_qualite')]
    public function displayLabelQualite(): Response
    {
        return $this->render('home/label_qualite.html.twig',[]);
    }
    
    #[Route('/chezpolux', name: 'app_agence')]
    public function agence(): Response
    {
        return $this->render('home/agence.html.twig', []);
    }
}
