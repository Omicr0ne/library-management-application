<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\InscriptionType;

final class InscriptionController extends AbstractController
{
    #[Route('/inscription', 'app_inscription', methods: ['GET', 'POST'])]
    public function inscription(
        Request $request,
        EntityManagerInterface $manager
    ): Response {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dd($form);
        }

        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
