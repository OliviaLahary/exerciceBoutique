<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'disabled' => true
            ])

            //->add('roles')

            ->add('old_password', PasswordType::class, [
                'label' => 'Ancien mot de passe',
                'mapped' => false,
                'attr' => [
                    'placeholder' => 'Votre ancien mot de passe',
                ]
            ])
            ->add('new_password', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'mapped' => false,
                'invalid_message' => 'Vos mots de passe doivent être identique',
                'first_options' => [
                    'label' => 'Nouveau mot de passe',
                    'constraints' => new Length([
                        'min' => 4,
                    ]),
                    'attr' => [
                        'placeholder' => 'Votre nouveau mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation du nouveau mot passe',
                    'constraints' => new Length([
                        'min' => 4,
                    ]),
                    'attr' => [
                        'placeholder' => 'Confirmer le nouveau mot de passe'
                    ]
                ]
            ])
            ->add('firstname', TextType::class, [
                'label'=>'Firstname',
                'disabled'=>true
            ])

            ->add('lastname', EmailType::class, [
                'label'=>'Lastname',
                'disabled'=>true
            ])

            ->add('submit', SubmitType::class, [
                'label'=>'Confirmer',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
