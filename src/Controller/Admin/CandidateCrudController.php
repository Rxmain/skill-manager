<?php

namespace App\Controller\Admin;

use App\Entity\Candidate;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CandidateCrudController extends AbstractCrudController
{


    public static function getEntityFqcn(): string
    {
        return Candidate::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $detailUser = Action::new('detailUser', 'Detail', 'fas fa-user')
            ->linkToCrudAction(Crud::PAGE_DETAIL)
            ->addCssClass('btn btn-info')
        ;

        return $actions
            ->add(Crud::PAGE_INDEX, $detailUser);
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('firstname'),
            TextField::new('lastname'),
            IntegerField::new('age'),
            TextField::new('profession'),
            TextField::new('email'),
            TextField::new('phone'),
            TextField::new('adresse'),
            TextField::new('postalcode'),
            TextField::new('city'),
            AssociationField::new('competences'),
            AssociationField::new('experiences'),
            ArrayField::new('roles'),
            TextField::new('password')



        ];
    }


}
