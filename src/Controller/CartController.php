<?php

namespace App\Controller;

use DateTime;
use App\Entity\TestCommand;
use App\Repository\GameRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\TestCommandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
        // PURCHASE
        $type = $session->get( 'type' , [] );
        $titre = $session->get( 'titre' , [] );
        $id_jeu = $session->get( 'id_jeu' , [] );
        $quantite = $session->get( 'quantite' , [] );
        $prix = $session->get( 'prix' , [] );

        $objects = [];

        // Reorganization of data in session for display purchase in twig
        for ($i = 0; $i < count($titre); $i++)
        {
            $object = [ "type" => $type[$i],
                        "titre" => $titre[$i], 
                        "id_jeu" => $id_jeu[$i],
                        "quantite" => $quantite[$i], 
                        "prix" => $prix[$i] ];

            $objects[] = $object;
        }

        // dump($objects);

        // RENTAL
        $renting = $session->get( 'renting', [] );

        $rentalObjects = [];

        if( $renting )
        {
            // dump($renting);

            // dump($renting[0]);
            // dump($renting[1]);
            // dump($renting[2]);
            // dump($renting[3]);

            // dd('stop');

            for( $j = 0; $j < count($renting[0]); $j++ )
            {
                $rentalObject = [ "titre" => $renting[0][$j],
                                "id_jeu" => $renting[1][$j],
                                "quantite" => $renting[2][$j],
                                "prix" => $renting[3][$j] ];

                $rentalObjects[] = $rentalObject;
            }
        }

        // foreach( $titre as $index => $value )
        // {
        //     $objects[] = 
        // }
        // $object = [ "titre" => $titre, "id" => $id_jeu, "quantite" => $quantite, "prix" => $prix ];

        // dump($titre);

        // dump($object);
        
        // dd($session);

        return $this->render('cart/newTest.html.twig', [
            "objects" => $objects,
            "rentalObjects" => $rentalObjects
        ]);
    }

    #[Route('/cart/add/{id}/{str}', name: 'app_cart_add')]
    public function add($id, $str, SessionInterface $session, GameRepository $gameRepo )
    {
        // // $toto = [ 'test1', 'test2'];
        // // $titre = array( "testToto" => $toto, 'tata');

        // dump($str);

        // $session->clear();
        // dd('stop');

        if( $str == "purchase" )
        {
            // dump("PURCHASE");

            $this->purchaseProcess( $id, $str, $session, $gameRepo );
    
            // dump($session);
        }
        else if( $str == "renting" )
        {
            // dump("RENTING");

            $this->rentingProcess( $id, $session, $gameRepo );

            // dump( $session );
        }

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

    #[Route('/cart/validate', name: 'app_validate')]
    public function validate( SessionInterface $session, EntityManagerInterface $entityManager )
    {
        $user = $this->getUser();

        // Purchase
        if( $session->get( 'quantite' , [] ) )
        {
            $new_command = new TestCommand();

            $new_command->setType("purchase");
            $new_command->setUser( $user );
    
            // Total_amount
            // $titre = $session->get( 'titre' , [] );
            // $id_jeu = $session->get( 'id_jeu' , [] );
            $quantite = $session->get( 'quantite' , [] );
            $prix = $session->get( 'prix' , [] );
            
            // dump($titre);
            $total_amount = 0;
    
            // Total amount calculation
            for ($i = 0; $i < count($quantite); $i++)
            {
                $total_amount += $quantite[$i] * $prix[$i];
            }
    
            // dump( $total_amount );
            $new_command->setTotalAmount( $total_amount );

            $date = new DateTime();
            $new_command->setCreatedAt( $date );
    
            $entityManager->persist( $new_command );
            $entityManager->flush();
        }

        // Renting
        if( $session->get( 'renting' , [] ) )
        {
            $new_command = new TestCommand();

            $new_command->setType("renting");
            $new_command->setUser( $user );

            // Amount of the subscription
            $new_command->setTotalAmount( 70 );

            $date = new DateTime();
            $new_command->setCreatedAt( $date );

            $entityManager->persist( $new_command );
            $entityManager->flush();
        }

        // dump($session);

        // Clear session
        // Renting
        $renting = $session->get( 'renting' , [] );
        if( $renting )
        {
            array_splice( $renting, 0, count($renting) );
            $session->set( 'renting', $renting );
        }

        // Type
        $type = $session->get( 'type' , [] );
        if( $type )
        {
            array_splice( $type, 0, count($type) );
            $session->set( 'type', $type );
        }

        // Titre
        $titre = $session->get( 'titre' , [] );
        if( $titre )
        {
            array_splice( $titre, 0, count($titre) );
            $session->set( 'titre', $titre );
        }

        // Id_jeu
        $id_jeu = $session->get( 'id_jeu' , [] );
        if( $id_jeu )
        {
            array_splice( $id_jeu, 0, count($id_jeu) );
            $session->set( 'id_jeu', $id_jeu );
        }

        // Quantite
        $quantite = $session->get( 'quantite' , [] );
        if( $quantite )
        {
            array_splice( $quantite, 0, count($quantite) );
            $session->set( 'quantite', $quantite );
        }

        // Prix
        $prix = $session->get( 'prix' , [] );
        if( $prix )
        {
            array_splice( $prix, 0, count($prix) );
            $session->set( 'prix', $prix );
        }

        // dump($session);
        
        // dd("stop");

        // dd("stop");
        return $this->redirectToRoute('app_cart');
    }

    public function rentingProcess( $id, SessionInterface $session, GameRepository $gameRepo )
    {
        $rent = $session->get( 'renting' , [] );

        if( empty($rent) )
        {
            // dump(" renting not existing ");
            $renting = [];
            $titre = [];
            $id_jeu = [];
            $quantite = [];
            $prix = [];
        }
        else
        {
            // dump(" renting existing ");
            $renting = $session->get( 'renting' , [] );
            // dump($renting);
            $titre = $renting[0];
            $id_jeu = $renting[1];
            $quantite = $renting[2];
            $prix = $renting[3];
            // dump($titre);
            // dump($id_jeu);
            // dump($quantite);
            // dump($prix);
            // dd('stop');
        }

        // Get game info
        $game = $gameRepo->find( $id );
        // dump($game);

        // Let's check if it's a new game
        $index = array_search( $game->getId(), $id_jeu );

        // dump($index);

        // It's a new game
        if( !is_int($index) )
        {
            // Updating infos node
            array_push( $titre, $game->getTitle() );
            array_push( $id_jeu, $game->getId() );
            array_push( $quantite, 1 );
            array_push( $prix, $game->getRentalPrice() );

            // dump( $titre );
            // dump( $id_jeu );
            // dump( $quantite );
            // dump( $prix );

            // dd("stop");

            // // Updating renting node
            if( !empty($rent) )
            {
                array_splice( $renting, 0, count($renting) );
            }

            array_push( $renting, $titre );
            array_push( $renting, $id_jeu );
            array_push( $renting, $quantite );
            array_push( $renting, $prix );

            // dump( $renting );

            $session->set( 'renting', $renting );
        }
        // Nothing to do, it is impossible for an user to rent the same game twice
        else
        {
            
        }
    }

    public function purchaseProcess( $id, $str, SessionInterface $session, GameRepository $gameRepo )
    {
        $title = $session->get( 'titre' , [] );
    
        if( empty($title) )
        {
            // dump(" purchase not existing ");
            $type = [];
            $titre = [];
            $id_jeu = [];
            $quantite = [];
            $prix = [];
        }
        else
        {
            // dump( " purchase existing ");
            $type = $session->get( 'type' , [] );
            $titre = $session->get( 'titre' , [] );
            $id_jeu = $session->get( 'id_jeu' , [] );
            $quantite = $session->get( 'quantite' , [] );
            $prix = $session->get( 'prix' , [] );
        }

        // Get game info
        $game = $gameRepo->find( $id );
        // dump($game);

        // Let's check if it's a new game
        $index = array_search( $game->getId(), $id_jeu );

        // dump($index);

        // It's a new game
        if( !is_int($index) )
        {
            // dump("newGame");
            // Only if it's a new game
            array_push( $type, $str );
            array_push( $titre, $game->getTitle() );
            array_push( $id_jeu, $game->getId() );
            array_push( $quantite, 1 );
            array_push( $prix, $game->getRentalPrice() );

            $session->set( 'type', $type);
            $session->set( 'titre', $titre);
            $session->set( 'id_jeu', $id_jeu);
            $session->set( 'quantite', $quantite);
            $session->set( 'prix', $prix);
        }
        // Update quantity
        else
        {
            // dump("not a new game");
            // dump($quantite);
            // dump($quantite[$index]);
            $quantite[$index] += 1;

            $session->set( 'quantite', $quantite);
        }
    }
}