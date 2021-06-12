<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Form\CompetencesType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompetencesController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/competences", name="competences")
     */
    public function index(): Response
    {
        $competences = $this->entityManager->getRepository(Competences::class)->findAll();

        return $this->render('competences/index.html.twig', [
            'controller_name' => 'CompetencesController',
            'competences' => $competences

        ]);
    }

    /**
     * @Route("/competences/new", name="new_competences")
     */

    public function new(Request $request): Response
    {
        $competences = new Competences();
        $form = $this->createForm(CompetencesType::class, $competences);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $competences = $form->getData();

            $this->entityManager->persist($competences);
            $this->entityManager->flush();
        }

        return $this->render('competences/new.html.twig', [
            'form_competences'=> $form->createView()
        ]);
    }
}
