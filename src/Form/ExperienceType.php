<?php

namespace App\Form;

use App\Entity\Experience;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ExperienceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Function')
            ->add('Place')
            ->add('Description')
            ->add('context')
            ->add('realisations')
            ->add('technical_environment')
            ->add('start_date')
            ->add('end_date')
            ->add('name')
            ->add('type_experience')
            ->add('entreprise')
            ->add('candidates')
            ->add('submit', SubmitType::class);

        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Experience::class,
        ]);
    }
}
