<?php

namespace App\Controller\Admin;

use App\Entity\Subscription;
use App\Form\SubscriptionType;
use App\Repository\SubscriptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/subscription')]
class SubscriptionController extends AbstractController
{
    #[Route('/', name: 'app_admin_subscription_index', methods: ['GET'])]
    public function index(SubscriptionRepository $subscriptionRepository): Response
    {
        return $this->render('admin/subscription/index.html.twig', [
            'subscriptions' => $subscriptionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_subscription_new', methods: ['GET', 'POST'])]
    public function new(Request $request, SubscriptionRepository $subscriptionRepository): Response
    {
        $subscription = new Subscription();
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscriptionRepository->add($subscription);
            return $this->redirectToRoute('app_admin_subscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/subscription/new.html.twig', [
            'subscription' => $subscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_subscription_show', methods: ['GET'])]
    public function show(Subscription $subscription): Response
    {
        return $this->render('admin/subscription/show.html.twig', [
            'subscription' => $subscription,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_subscription_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Subscription $subscription, SubscriptionRepository $subscriptionRepository): Response
    {
        $form = $this->createForm(SubscriptionType::class, $subscription);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $subscriptionRepository->add($subscription);
            return $this->redirectToRoute('app_admin_subscription_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/subscription/edit.html.twig', [
            'subscription' => $subscription,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_subscription_delete', methods: ['POST'])]
    public function delete(Request $request, Subscription $subscription, SubscriptionRepository $subscriptionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$subscription->getId(), $request->request->get('_token'))) {
            $subscriptionRepository->remove($subscription);
        }

        return $this->redirectToRoute('app_admin_subscription_index', [], Response::HTTP_SEE_OTHER);
    }
}
