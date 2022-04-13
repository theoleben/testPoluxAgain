<?php

namespace App\Controller;

use App\Entity\User;
use DateTime;
use App\Entity\UserSubscription;
use App\Repository\SubscriptionRepository;
use App\Repository\UserRepository;
use App\Repository\UserSubscriptionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserSubscriptionController extends AbstractController
{
    #[Route('/user/subscription', name: 'app_user_subscription')]
    public function index(): Response
    {
        return $this->render('user_subscription/index.html.twig', [
            'controller_name' => 'UserSubscriptionController',
        ]);
    }

    // Cette route permet de mettre à jour la table user_subscription avec le user connecté et son abonnement
    #[Route('/user/insert-{idSub}', name: 'app_user_subscription_insert')]
    public function insert( int $idSub, SubscriptionRepository $sub_repo, EntityManagerInterface $entityManager ) : Response
    {
        $user = $this->getUser();
        // dd( $user )

        if( $user )
        {
            $new_subscription = new UserSubscription();

            // $user = $user_repo->find( $idUser );
            $sub = $sub_repo->find( $idSub );
            
            $new_subscription->setUser( $user );
            $new_subscription->setSubscription( $sub );
    
            $date = new DateTime();
    
            $new_subscription->setStartDate( $date );
            $new_subscription->setIsDiscountUsed( 0 );
    
            $entityManager->persist( $new_subscription );
            $entityManager->flush();
    
            return $this->render('user_subscription/index.html.twig', [
                'controller_name' => 'Lets go',
            ]);
        }
        else
        {
            return $this->redirectToRoute( 'app_login', [], Response::HTTP_SEE_OTHER );
        }
    }

    #[Route('/user/display', name: 'app_user_subscription_display')]
    public function display( ): Response
    {
        // $user = $this->getUser();
        // $user->getSubscriptions();
        // dd( $user );

        // $my_user = new User( $user );
        // dd( $my_user );
        // $my_user->getUserSubscriptions();
        // $user->getUserSubscriptions();


        return $this->render('user_subscription/testDisplay.html.twig', [
            'controller_name' => 'UserSubscriptionController',
        ]);
    }
}
