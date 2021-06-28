<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\User;
use App\Form\CompetencesType;
use App\Repository\CompetencesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
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
     * @Route("/competences/{id}", name="competences-show")
     */

    public function show ($id) {
        $competence = $this->getDoctrine()->getRepository(Competences::class)->find($id);

        return $this->render('competences/competences.html.twig', array('competence' => $competence));
    }


    /**
     * @Route("/competences/{id}/edit/{user}", name="admin_competences_edit")
     *
     */
    public function edit(Competences $competences, User $user, Request $request, EntityManagerInterface $em, $id) : Response
    {
        $competence = $this->getDoctrine()->getRepository(Competences::class)->find($id);


        $form = $this->createForm(CompetencesType::class, $competences);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $competences = $form->getData();
            $em->persist($competences);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('profil/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

}
