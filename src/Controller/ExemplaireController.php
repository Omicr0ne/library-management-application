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
}
