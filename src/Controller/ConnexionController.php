<?php

// Ce controlleur gère les inscriptions et les connexions

namespace App\Controller;

use App\Entity\User;
use App\Form\InscriptionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

final class ConnexionController extends AbstractController
{
    #[Route('/connexion', name: 'app_connexion', methods: ['GET', 'POST'])]
    public function connexion(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('connexion/index.html.twig', [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError()
        ]);
    }

    #[Route('/deconnexion', 'app_deconnexion')]
    public function deconnexion()
    {
        // déconnexion
    }

    #[Route('/inscription', 'app_inscription', methods: ['GET', 'POST'])]
    public function inscription(): Response
    {
        $user = new User();
        $form = $this->createForm(InscriptionType::class, $user);
        return $this->render('connexion/inscription.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
