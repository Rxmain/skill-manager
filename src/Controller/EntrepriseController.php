<?php

namespace App\Controller;

use App\Entity\Entreprise;
use App\Form\EntrepriseType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EntrepriseController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/entreprise", name="entreprise")
     */
    public function index(): Response
    {
        $entreprise = $this->entityManager->getRepository(Entreprise::class)->findAll();

        return $this->render('entreprise/index.html.twig', [
            'controller_name' => 'EntrepriseController',
            'entreprise' => $entreprise
        ]);
    }

    /**
     * @Route("/entreprise/new", name="new_entreprise")
     */

    public function new(Request $request): Response
    {
        $entreprise = new Entreprise();
        $form = $this->createForm(EntrepriseType::class, $entreprise);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entreprise = $form->getData();

            $this->entityManager->persist($entreprise);
            $this->entityManager->flush();
        }

        return $this->render('entreprise/new.html.twig', [
            'form_entreprise'=> $form->createView()
        ]);
    }
}
