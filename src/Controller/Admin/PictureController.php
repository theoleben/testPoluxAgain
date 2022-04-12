<?php

namespace App\Controller\Admin;

use App\Entity\Picture;
use App\Form\PictureType;
use App\Repository\PictureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/picture')]
class PictureController extends AbstractController
{
    #[Route('/', name: 'app_admin_picture_index', methods: ['GET'])]
    public function index(PictureRepository $pictureRepository): Response
    {
        return $this->render('admin/picture/index.html.twig', [
            'pictures' => $pictureRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_admin_picture_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PictureRepository $pictureRepository): Response
    {
        $picture = new Picture();
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($fichier = $form->get('name')->getData()){
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= "_" . uniqid() . "." . $fichier->guessExtension();
                $fichier->move("images", $nomFichier);
                $picture->setName($nomFichier);
            }
            $pictureRepository->add($picture);
            return $this->redirectToRoute('app_admin_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/picture/new.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_picture_show', methods: ['GET'])]
    public function show(Picture $picture): Response
    {
        return $this->render('admin/picture/show.html.twig', [
            'picture' => $picture,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_admin_picture_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        $form = $this->createForm(PictureType::class, $picture);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if($fichier = $form->get('name')->getData()){
                $nomFichier = pathinfo($fichier->getClientOriginalName(), PATHINFO_FILENAME);
                $nomFichier = str_replace(" ", "_", $nomFichier);
                $nomFichier .= "_" . uniqid() . "." . $fichier->guessExtension();
                $fichier->move("images", $nomFichier);
                $picture->setName($nomFichier);
            }
            $pictureRepository->add($picture);
            return $this->redirectToRoute('app_admin_picture_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/picture/edit.html.twig', [
            'picture' => $picture,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_admin_picture_delete', methods: ['POST'])]
    public function delete(Request $request, Picture $picture, PictureRepository $pictureRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$picture->getId(), $request->request->get('_token'))) {
            $pictureRepository->remove($picture);
        }

        return $this->redirectToRoute('app_admin_picture_index', [], Response::HTTP_SEE_OTHER);
    }
}
