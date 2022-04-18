<?php

namespace App\Controller;

use App\Repository\GameRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, GameRepository $gameRepository): Response
    {
        // William
        // $cart = $session->get('cart', []);
        // $cartWithData = [];
        // foreach($cart as $id => $quantity){
        //     $cartWithData[] = [
        //         'game' => $gameRepository->find($id),
        //         'quantity' => $quantity
        //     ];
        
        // }
        // $total = 0;
        // foreach ($cartWithData as $item) {
        //     $totalItem = $item['game']->getSellingPrice() * $item['quantity'];
        //     $total += $totalItem;
        // }

        // return $this->render('cart/index.html.twig', [
        //     'games' => $cartWithData,
        //     'total' => $total
        // ]);

        // Théo
        $titre = $session->get( 'titre' , [] );
        // $id_jeu = $session->get( 'id_jeu' , [] );
        // $quantite = $session->get( 'quantite' , [] );
        // $prix = $session->get( 'prix' , [] );

        dump($titre);
        
        dd($session);

        return $this->render('cart/index.html.twig', [
            "titres" => $titre
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add($id, SessionInterface $session, GameRepository $gameRepo )
    {
        // // $toto = [ 'test1', 'test2'];
        // // $titre = array( "testToto" => $toto, 'tata');

        dump($session);

        $title = $session->get( 'titre' , [] );

        if( empty($title) )
        {
            dump(" not existing ");
            $titre = [];
            $id_jeu = [];
            $quantite = [];
            $prix = [];
        }
        else
        {
            dump( "existing ");
            $titre = $session->get( 'titre' , [] );
            $id_jeu = $session->get( 'id_jeu' , [] );
            $quantite = $session->get( 'quantite' , [] );
            $prix = $session->get( 'prix' , [] );
        }

        // Get game info
        $game = $gameRepo->find( $id );
        dump($game);

        // Let's check if it's a new game
        $index = array_search( $game->getId(), $id_jeu );

        dump($index);

        // It's a new game
        if( !is_int($index) )
        {
            dump("newGame");
            // Only if it's a new game
            array_push( $titre, $game->getTitle() );
            array_push( $id_jeu, $game->getId() );
            array_push( $quantite, 1 );
            array_push( $prix, $game->getRentalPrice() );

            $session->set( 'titre', $titre);
            $session->set( 'id_jeu', $id_jeu);
            $session->set( 'quantite', $quantite);
            $session->set( 'prix', $prix);
        }
        // Update quantity
        else
        {
            dump("not a new game");
            // dump($quantite);
            // dump($quantite[$index]);
            $quantite[$index] += 1;

            $session->set( 'quantite', $quantite);
        }

        // if( empty($panier) )
        // {
        //     dump("set");
        //     $panier->set( 'titre', $titre);
        //     $panier->set( 'id_jeu', $id_jeu);
        // }

        // $panier = $session->get( 'panier', [] );
        // dump($panier);

        // dump($session);

        // $id_games = $session->get( 'id_jeu', [] );
        // dump($id_games);

        // Clear session
        // $session->clear();

        // dd('stop');
        
        // if( !isset( $session['panier'] ) )
        // {
        //     dd("not here");

        //     // $_SESSION['panier'] = array();
    
        //     //     $_SESSION['panier']['titre'] = array();
        //     //     $_SESSION['panier']['id_produit'] = array();
        //     //     $_SESSION['panier']['quantite'] = array();
        //     //     $_SESSION['panier']['prix'] = array();
        // }
        // else
        // {
        //     dd("here");
        // }

                // dump($session);
        // dd("stop");

        // William
        // $cart = $session->get('cart', []);
        // dump($cart);
        // if(!empty($cart[$id])){
        //     $cart[$id]++;
        // }else{
        // $cart[$id] = 1;
        // }
        // $session->set('cart', $cart);

        // $session->clear();

        // dd($session);

        return $this->redirectToRoute('app_cart');
    }

    #[Route('/cart/remove/{id}', name: 'app_cart_remove')]
    public function remove($id, SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        if(!empty($id)){
            unset($cart[$id]);
        }
        $session->set('cart', $cart);
        return $this->redirectToRoute('app_cart');
    }
    
}