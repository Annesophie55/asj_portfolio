<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request): Response
    {
        $formContact = $this->createForm(ContactType::class, null, [
            'attr' => ['id' => 'contactForm'] // Ajouter l'ID ici
        ]);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $contactData = $formContact->getData();
            // Envoyer les données par e-mail, etc.

            return $this->redirectToRoute('success_page');
        }

        return $this->render('contact/index.html.twig', [
            'formContact' => $formContact->createView(),
            'addChevronFooter' => false
        ]);
    }
}
