<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserEditType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UserRepository;


class UserEditController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/user/edit", name="user_edit")
     */
    public function index(): Response
    {
        return $this->render(
            'user_edit/index.html.twig',
            [
                'controller_name' => 'UserEditController',
            ]
        );
    }

    /**
     * @Route("/user/edit/{id}", name="edit-user")
     */
    public function edit(User $user, Request $request, EntityManagerInterface $em, $id) : Response
    {
        $form = $this->createForm(UserEditType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $user = $form->getData();
            $em->persist($user);
            $em->flush();
            return $this->redirectToRoute('admin');
        }
        return $this->render('profil/edit.html.twig', [
            'edit_user' => $form->createView()
        ]);
    }
}
