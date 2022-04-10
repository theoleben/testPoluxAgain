<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\User1Type;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface as Hasher;

#[Route('/profil')]
class ProfilController extends AbstractController
{
    #[Route('/', name: 'app_profil_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('profil/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    // #[Route('/new', name: 'app_profil_new', methods: ['GET', 'POST'])]
    // public function new(Request $request, UserRepository $userRepository): Response
    // {
    //     $user = new User();
    //     $form = $this->createForm(User1Type::class, $user);
    //     $form->handleRequest($request);

    //     if ($form->isSubmitted() && $form->isValid()) {
    //         $userRepository->add($user);
    //         return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
    //     }

    //     return $this->renderForm('profil/new.html.twig', [
    //         'user' => $user,
    //         'form' => $form,
    //     ]);
    // }

    // #[Route('/{id}', name: 'app_profil_show', methods: ['GET'])]
    // public function show(User $user): Response
    // {
    //     return $this->render('profil/show.html.twig', [
    //         'user' => $user,
    //     ]);
    // }

    #[Route('/{id}/edit', name: 'app_profil_edit', methods: ['GET', 'POST'], requirements: ['id'=>'[0-9]+'])]
    public function edit(Request $request, User $user, UserRepository $userRepository, Hasher $hasher): Response
    {
        $form = $this->createForm(User1Type::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($mdp = $form->get('password')->getData())
            {
                $password = $hasher->hashPassword($user, $mdp);
                $user->setPassword($password);
            }

            $userRepository->add($user);
            return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('profil/edit.html.twig', [
            'user' => $user,
            'form' => $form,
            // 'form' => $form->createView(),
            'users' => $user,
        ]);
    }

    #[Route('/{id}', name: 'app_profil_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $userRepository->remove($user);
        }

        return $this->redirectToRoute('app_profil_index', [], Response::HTTP_SEE_OTHER);
    }
}
