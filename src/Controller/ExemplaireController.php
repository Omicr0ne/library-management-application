<?php

namespace App\Controller;

use App\Entity\Exemplaire;
use App\Form\NewExemplaireType;
use App\Repository\ExemplaireRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ExemplaireController extends AbstractController
{
    // Affiche tous les exemplaires
    #[Route('/exemplaire', name: 'app_exemplaire', methods: ['GET'])]
    public function index(ExemplaireRepository $repository): Response
    {
        return $this->render('exemplaire/index.html.twig', [
            'exemplaires' => $repository->findAll()
        ]);
    }

    // Formulaire de création d'un exemplaire
    #[Route('admin/newExemplaire', name: 'app_newExemplaire', methods: ['GET', 'POST'])]
    public function newExemplaire(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $exemplaire = new Exemplaire();
        $form = $this->createForm(NewExemplaireType::class, $exemplaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $exemplaire = $form->getData();
            $manager->persist($exemplaire);
            $manager->flush();
            return $this->redirectToRoute('app_exemplaire');
        }

        return $this->render('admin/newExemplaire.html.twig', [
            'form' => $form->createView()
        ]);
    }

    // Formulaire de modification des exemplaires
    #[Route('admin/editExemplaire/{id}', name: 'app_editExemplaire', methods: ['GET', 'POST'])]
    public function editExemplaire(Request $request, EntityManagerInterface $manager, Exemplaire $exemplaire): Response
    {
        $form = $this->createForm(NewExemplaireType::class, $exemplaire);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $exemplaire = $form->getData();
            $manager->persist($exemplaire);
            $manager->flush();
            return $this->redirectToRoute('app_exemplaire');
        }

        return $this->render('admin/editExemplaire.html.twig', ['form' => $form->createView()]);
    }

    // Suppression d'un exemplaire
    #[Route('admin/deleteExemplaire/{id}', name: 'app_deleteExemplaire', methods: ['POST'])]
    public function delete(EntityManagerInterface $manager, Exemplaire $exemplaire): Response
    {
        if (!$exemplaire) {
            return $this->redirectToRoute('app_ouvrage');
        }
        $manager->remove($exemplaire);
        $manager->flush();
        return $this->redirectToRoute('app_exemplaire');
    }
}
