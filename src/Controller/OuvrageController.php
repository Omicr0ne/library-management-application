<?php

namespace App\Controller;

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
        return $this->render('admin/newOuvrage.thml.twig');
    }
}
