<?php

namespace App\Controller;

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
}
