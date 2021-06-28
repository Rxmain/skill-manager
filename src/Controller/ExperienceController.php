<?php

namespace App\Controller;

use App\Entity\Competences;
use App\Entity\Experience;
use App\Entity\User;
use App\Form\CompetencesType;
use App\Form\ExperienceType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExperienceController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/experience", name="experience")
     */
    public function index(): Response
    {
        $experience = $this->entityManager->getRepository(Experience::class)->findAll();

        return $this->render('experience/index.html.twig', [
            'controller_name' => 'ExperienceController',
            'experiences' => $experience
        ]);
    }

    /**
     * @Route("/experience/new/{id}", name="new_experience")
     */

    public function new(Request $request,  UserRepository $userRepository): Response
    {
        $id = $request->get('id');
        $user = $userRepository->find($id);

        $experience = new Experience();
        $form = $this->createForm(ExperienceType::class, $experience);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $experience = $form->getData();

            $this->entityManager->persist($experience->setUser($user));
            $this->entityManager->flush();

            return $this->redirectToRoute('admin');

        }

        return $this->render('experience/new.html.twig', [
            'form_experience'=> $form->createView()
        ]);
    }
    /**
     * @Route("/experience/{id}/edit/{user}", name="admin_experience_edit")
     *
     */
    public function edit(Experience $experience, User $user, Request $request, EntityManagerInterface $em, $id) : Response
    {
        $experiences = $this->getDoctrine()->getRepository(Experience::class)->find($id);


        $form = $this->createForm(ExperienceType::class, $experience);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $experience = $form->getData();
            $em->persist($experience);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('profil/new.html.twig', [
            'articleForm' => $form->createView()
        ]);
    }

}
