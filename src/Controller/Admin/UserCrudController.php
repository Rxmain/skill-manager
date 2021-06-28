<?php

namespace App\Controller\Admin;

use App\Entity\Competences;
use App\Entity\Experience;
use App\Entity\TypeExperience;
use App\Entity\User;
use App\Form\CompetencesType;
use App\Form\ExperienceType;
use App\Repository\CompetencesRepository;
use App\Repository\ExperienceRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Vich\UploaderBundle\Form\Type\VichImageType;

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

            BooleanField::new('collab')->setPermission('ROLE_ADMIN'),

            TextField::new('password'),

            ArrayField::new('roles')->setPermission('ROLE_ADMIN'),

            AssociationField::new('competences')->autocomplete(),
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
    public function detailedInfo (Request $request, UserRepository $userRepository, EntityManagerInterface $em){
        $id = $request->get('id');
        $user = $userRepository->find($id);

        $skills = new Competences();
        $form = $this->createForm(CompetencesType::class, $skills);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $skills = $form->getData();

            $this->entityManager->persist($skills->setUser($user));
            $this->entityManager->flush();
        }

        $experiences = new Experience();
        $formExperience = $this->createForm(ExperienceType::class, $experiences);

        $formExperience->handleRequest($request);
        if ($formExperience->isSubmitted() && $formExperience->isValid()) {
            $experiences = $formExperience->getData();

            $this->entityManager->persist($experiences->setUser($user));
            $this->entityManager->persist($user);

            $this->entityManager->flush();
        }


        return $this->render('profil/profil.html.twig', [
            'user' => $user,
            'form_competences'=> $form->createView(),
            'form_experiences' => $formExperience->createView(),
        ]);

    }



}
