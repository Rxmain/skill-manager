<?php

namespace App\Form;

use  App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Vich\UploaderBundle\Form\Type\VichImageType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'required'    => true,
                'constraints' => [
                    new Length(
                        [
                            'min' => 2,
                            'max' => 50
                        ]
                    )
                ]
            ])
            ->add('lastname', TextType::class, [
                'required'    => true,
                'constraints' => [
                    new Length(
                        [
                            'min' => 2,
                            'max' => 50
                        ]
                    )
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse mail',
                'attr'  => [
                    'placeholder' => 'Merci de saisir votre adresse mail.'
                ],
                'required'    => true
            ])
            ->add('password', RepeatedType::class, [
                'type'            => PasswordType::class,
                'invalid_message' => 'Le mot de passe et la confirmation doivent être identique',
                'required'        => true,
                'first_options'   => [
                    'label' => 'Mot de passe',
                    'attr'  => ['placeholder' => 'Merci de saisir votre mot de passe.']
                ],
                'second_options'  => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr'  => ['placeholder' => 'Merci de confirmer votre mot de passe.']
                ]
            ])
            ->add('age')
            ->add('profession')
            ->add('phone')
            ->add('adresse')
            ->add('postalcode')
            ->add('city')
            ->add('collab')
//            ->add('thumbnail', VichImageType::class)




            ->add('register', SubmitType::class, [
                'label' => 'S\'inscrire'
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
