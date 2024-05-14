<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $formContact = $this->createForm(ContactType::class, null, [
            'attr' => ['id' => 'contactForm'] 
        ]);
        $formContact->handleRequest($request);

        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $contactData = $formContact->getData();
            $email = (new Email())
            ->from($contactData['email'])
            ->to('jackowska.annesophie@outlook.fr')
            ->subject($contactData['objet'])
            ->text($contactData['email'] );

        $mailer->send($email);

            return $this->redirectToRoute('app_contact');
        }

        return $this->render('contact/index.html.twig', [
            'formContact' => $formContact->createView(),
            'addChevronFooter' => false
        ]);
    }
}
