<?php

namespace App\Controller\Admin;

use App\Entity\Game;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as Hasher;

#[Route('/admin/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_admin_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/insertWish/{id}', name: 'insert_wishlist', methods: ['GET'])]
    public function insertWish( EntityManagerInterface $em, Request $request, Game $gameWish): Response
    {
        $userWish = $this->getUser();

        if( !$userWish)
        {
            return $this->redirectToRoute( 'app_login', [], Response::HTTP_SEE_OTHER);
        }else
        {
            $userWish = $this->getUser();
        
            // dd($userWish);
    
            $userWish->addGame($gameWish); 
    
                
            $em->flush();
            
    
            return $this->redirectToRoute( 'app_profil_index', [], Response::HTTP_SEE_OTHER);
        }
       
    }



    #[Route('/new', name: 'app_admin_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, UserRepository $userRepository, Hasher $hasher): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // if( in_array("ROLE_ADMIN", $user->getRoles()))
            // {
            //     $newUser = new User;
            //     $newUser->setNom($user->getNom());
            //     $newUser->setEmail($form->get('email')->getData());
            // }
            // else
            // {
            //     $user->setRoles(['ROLE_ADMIN']);
            // }

            $mdp = $form->get('password')->getData();
            $password = $hasher->hashPassword($user, $mdp);
            $user->setPassword($password);
            $userRepository->add($user);
            return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/user/new.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('admin/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, Hasher $hasher, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            if($user->getInscriptionNewsletter() == null )
            {
                $user->setInscriptionNewsletter(0);
            }

            if($email= $form->get('email')->getData())
            {
                $user->setEmail($email);
            }

            if($mdp = $form->get('password')->getData())
            {
                $password = $hasher->hashPassword($user, $mdp);
                $user->setPassword($password);
            }
            
            $userRepository->add($user);

            $em->flush();

            return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
        }

        

        return $this->renderForm('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_admin_user_index', [], Response::HTTP_SEE_OTHER);
    }
}
