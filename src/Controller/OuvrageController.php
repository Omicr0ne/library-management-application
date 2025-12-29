<?php

namespace App\Controller;

use App\Entity\Ouvrage;
use App\Form\OuvrageType;
use App\Repository\OuvrageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OuvrageController extends AbstractController
{
    // Affiche tous les ouvrages
    #[Route('/ouvrage', name: 'app_ouvrage', methods: ['GET'])]
    public function index(OuvrageRepository $repository, Request $request): Response
    {
        return $this->render('ouvrage/index.html.twig', [
            'ouvrages' => $repository->findAll()
        ]);
    }

    #[Route('admin/newOuvrage', name: 'app_newOuvrage', methods: ['GET', 'POST'])]
    public function newOuvrage(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $ouvrage = new Ouvrage();
        $form = $this->createForm(OuvrageType::class, $ouvrage);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $ouvrage = $form->getData();
            $manager->persist($ouvrage);
            $manager->flush();
        }

        return $this->render('admin/newOuvrage.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
