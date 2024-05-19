<?php

namespace App\Controller;

use App\Entity\Project;
use App\Form\ProjectType;
use App\Repository\ProjectRepository;
use App\Repository\TechnologyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

#[Route('/project')]
class ProjectController extends AbstractController
{
    #[Route('/{techno_id}', name: 'app_project_index', methods: ['GET', 'POST'])]
    public function index(ProjectRepository $projectRepository, Request $request, EntityManagerInterface $entityManager, TechnologyRepository $technologyRepository, $techno_id=null): Response
    {
        $data = $techno_id ? $projectRepository->findByTechnology($techno_id) : $projectRepository->findAll();
        if(!($data)) {
            $this->addFlash(
                'error', 
                'Il n\'y a pas de projet avec cette technologie' 
            );
        }

        $technos = $technologyRepository->findAll();

        $project = new Project();
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $form->get('img')->getData();
            if ($file) {
                $filename = uniqid().'.'.$file->guessExtension();
                try {
                    $file->move($this->getParameter('projects_directory'), $filename);
                } catch (FileException $e) {
                    // Gérer l'erreur
                }
                $project->setImg($filename);
            }

            $entityManager->persist($project);
            $entityManager->flush();


            $this->addFlash(
                'success', // Type de message, peut être 'success', 'error', 'warning', etc.
                'Le projet a été ajouté avec succès !' // Message à afficher
            );

            return $this->redirectToRoute('app_project_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('project/index.html.twig', [
            'data' => $data,
            'showImage' => true,
            'pageProject' =>true,
            'addChevronFooter' => true,
            'adminTools'=> false,
            'project' => $project,
            'form' => $form,
            'technos'=>$technos,
        ]);
    }

    #[Route('/admin', name: 'app_project__admin_index', methods: ['GET'])]
    public function adminToolOnProjectIndex(ProjectRepository $projectRepository): Response
    {
        return $this->render('project/index.html.twig', [
            'projects' => $projectRepository->findAll(),
            'showImage' => true,
            'pageProject' =>true,
            'addChevronFooter' => true,
            'adminTools'=> true
        ]);
    }

    #[Route('/{id}/edit', name: 'app_project_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ProjectType::class, $project);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $newFile = $form->get('img')->getData();
            if($newFile){
                $oldFileName = $project->getImg();
                if ($oldFileName) {
                    $oldFilePath = $this->getParameter('projects_directory') . '/' . $oldFileName;
                    if (file_exists($oldFilePath)) {
                        unlink($oldFilePath); // Supprimer l'ancien fichier
                    }
                }

                $newFilename = uniqid().'.'.$newFile->guessExtension();
                try {
                    $newFile->move($this->getParameter('projects_directory'), $newFilename);
                    $project->setImg($newFilename);
                } catch (FileException $e) {
                    // Gérer l'erreur
                    $this->addFlash('error', 'Erreur lors de la sauvegarde du fichier.');
                }
            }
        $entityManager->flush();
        $this->addFlash('success', 'Le projet a été mis à jour avec succès !');
        return $this->redirectToRoute('app_project_index');
    }
        

        return $this->render('project/edit.html.twig', [
            'project' => $project,
            'form' => $form,
            'addChevronFooter' => false,
        ]);
    }

    #[Route('delete/{id}', name: 'app_project_delete', methods: ['POST'])]
    public function delete(Request $request, Project $project, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$project->getId(), $request->getPayload()->get('_token'))) {
            $filePath = $this->getParameter('projects_directory') . '/' . $project->getImg();
            if($project->getImg() && file_exists($filePath)) {
                unlink($filePath);
            }
            try {
                $entityManager->remove($project);
                $entityManager->flush();
            } catch (\Exception $e) {
                // Log or dump the exception to see if something goes wrong here
                $this->addFlash('error', 'Impossible de supprimer le projet: ' . $e->getMessage());
                dump($e); // Only for development debugging, remove in production
                return $this->redirectToRoute('app_project_index');
            }
        }
    
        return $this->redirectToRoute('app_project_index');
    }
    
}
