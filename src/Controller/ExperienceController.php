<?php

namespace App\Controller;

use App\Entity\Experience;
use App\Form\ExperienceType;
use App\Repository\ExperienceRepository;
use App\Repository\TechnologyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


#[Route('/experience')]
class ExperienceController extends AbstractController
{
    #[Route('/', name: 'app_experience_index', methods: ['GET', 'POST'])]
    public function index(ExperienceRepository $experienceRepository, Request $request, EntityManagerInterface $entityManager): Response
    {
    
        $data = $experienceRepository->findAll();

        $experience = new Experience();

        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($experience);
            $entityManager->flush();

            return $this->redirectToRoute('app_experience_index', [], Response::HTTP_SEE_OTHER);
        }



        
        return $this->render('experience/index.html.twig', [
            'data' => $data,
            'showImage' => false,
            'pageProject' =>false,
            'addChevronFooter' => true,
            'adminTools'=> false,
            'experience' => $experience,
            'form' => $form,
        ]);
    }


    #[Route('/admin', name: 'app_experience_admin_index', methods: ['GET'])]
    public function adminToolsOnExperienceIndex(ExperienceRepository $experienceRepository): Response
    {

        return $this->render('experience/index.html.twig', [
            'experiences' => $experienceRepository->findAll(),
            'showImage' => false,
            'pageProject' =>false,
            'addChevronFooter' => true,
            'adminTools'=> true,
        ]);
    }

    #[Route('/{id}', name: 'app_experience_show', methods: ['GET'])]
    public function show(Experience $experience): Response
    {
        return $this->render('experience/show.html.twig', [
            'experience' => $experience,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_experience_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_experience_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('experience/edit.html.twig', [
            'experience' => $experience,
            'form' => $form,
            'addChevronFooter' => false,
        ]);
    }

    #[Route('/{id}', name: 'app_experience_delete', methods: ['POST'])]
    public function delete(Request $request, Experience $experience, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$experience->getId(), $request->getPayload()->get('_token'))) {
            $entityManager->remove($experience);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_experience_index', [], Response::HTTP_SEE_OTHER);
    }
}
