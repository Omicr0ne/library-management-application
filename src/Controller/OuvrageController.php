<?php

namespace App\Controller;

use App\Entity\Ouvrage;
use App\Form\OuvrageType;
use App\Repository\OuvrageRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class OuvrageController extends AbstractController
{
    #[Route('/ouvrage', name: 'app_ouvrage', methods: ['GET'])]
    public function index(OuvrageRepository $repository): Response
    {
        return $this->render('ouvrage/index.html.twig', [
            'ouvrages' => $repository->findAll()
        ]);
    }
    #[Route('/newOuvrage', name: 'app_newOuvrage', methods: ['GET', 'POST'])]
    public function newOuvrage(): Response
    {
        $ouvrage = new Ouvrage();
        $form = $this->createForm(OuvrageType::class, $ouvrage);



        return $this->render('admin/newOuvrage.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
