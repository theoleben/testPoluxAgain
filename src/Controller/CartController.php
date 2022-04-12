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
        $cart = $session->get('cart', []);
        $cartWithData = [];
        foreach($cart as $id => $quantity){
            $cartWithData[] = [
                'game' => $gameRepository->find($id),
                'quantity' => $quantity
            ];
        
        }
        $total = 0;
        foreach ($cartWithData as $item) {
            $totalItem = $item['game']->getSellingPrice() * $item['quantity'];
            $total += $totalItem;
        }
        return $this->render('cart/index.html.twig', [
            'games' => $cartWithData,
            'total' => $total
        ]);
    }

    #[Route('/cart/add/{id}', name: 'app_cart_add')]
    public function add($id, SessionInterface $session)
    {
        $cart = $session->get('cart', []);
        if(!empty($cart[$id])){
            $cart[$id]++;
        }else{
        $cart[$id] = 1;
        }
        $session->set('cart', $cart);
        

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