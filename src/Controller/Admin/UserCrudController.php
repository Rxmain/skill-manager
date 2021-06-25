<?php

namespace App\Controller\Admin;

use App\Entity\Competences;
use App\Entity\Experience;
use App\Entity\User;
use App\Form\CompetencesType;
use App\Form\ExperienceType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserCrudController extends AbstractCrudController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            EmailField::new('email'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            IntegerField::new('age'),
            TextField::new('profession'),
            TextField::new('email'),
            TextField::new('phone'),
            TextField::new('adresse'),
            TextField::new('postalcode'),
            TextField::new('city'),

            BooleanField::new('collab'),


            TextField::new('password'),
            ArrayField::new('roles'),


            AssociationField::new('competences'),
            AssociationField::new('experiences'),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        $detailsuser = Action::new('page-detail', 'Profil','fa fa-user')
            ->addCssClass('btn btn-info')
            ->linkToRoute('user-detail', function(User $entity) {
                return [
                    'id' =>$entity->getId()
                ];
            });

        return $actions
            ->add(Crud::PAGE_INDEX, $detailsuser);
    }

    /**
     * @Route(path="user-detail-single", name="user-detail")
     *
     */
    public function detailedInfo (Request $request, UserRepository $userRepository){
        $id = $request->get('id');
        $user = $userRepository->find($id);


        $skills = new Competences();

        $form = $this->createForm(CompetencesType::class, $skills);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $id = $form->getData();


            $this->entityManager->persist($skills);
            $this->entityManager->persist($user);

            $this->entityManager->flush($skills);
        }

        $experience = new Experience();
        $formExperience = $this->createForm(ExperienceType::class, $experience);

        $formExperience->handleRequest($request);

        if ($formExperience->isSubmitted() && $formExperience->isValid()) {
            $experience = $formExperience->getData();

            $this->entityManager->persist($user);

            $this->entityManager->flush($user);
        }


        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'form_skills' => $form->createView(),
            'form_experience' => $formExperience->createView()
        ]);
    }



}
