<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom',
                'attr' =>[
                    'placeholder' => 'Votre prénom',
                ]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Nom',
                'attr' =>[
                    'placeholder' => 'Votre nom',
                ]
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' =>[
                    'placeholder' => 'Votre email',
                ]
            ])
            ->add('password', RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'invalid_message' => 'Vos mots de passe doivent être identique',
                'first_options' => [
                    'label' => 'Mot de passe',
                    'constraints' => new Length([
                        'min' => 4,
                    ]),
                    'attr' => [
                        'placeholder' => 'Votre mot de passe'
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmation de mot passe',
                    'constraints' => new Length([
                        'min' => 4,
                    ]),
                    'attr' => [
                        'placeholder' => 'Confirmer le mot de passe'
                    ]
                ]
            ])
            ->add('submit', SubmitType::class,[
                'label' => "M'inscrire",
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
