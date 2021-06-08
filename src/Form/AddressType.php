<?php

namespace App\Form;

use App\Entity\Adresse;
use Doctrine\Common\Annotations\Annotation\Required;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'label'=>'Titre',
                'required'=> false,
                'attr'=>[ 
                    'placeholder' =>''
                ]
            ])
            ->add('firstname', TextType::class,[
                'label'=>'Prénom',
                'required'=> true,
                'attr' => [
                    'placeholder' =>'Votre Prénom'
                ]
            ])
            ->add('lastname', TextType::class,[
                'label'=> 'Nom',
                'required'=> true,
                'attr' => [
                    'placeholder' =>'Votre Nom'
                    
                ]
            ])
            ->add('company', TextType::class,[
                'label'=>'Entreprise',
                'required'=> false,
                'attr' => [
                    'placeholder' =>' Votre Entreprise'
                ]
            ])
            ->add('phone', TelType::class,[
                'label' =>'Téléphonne',
                'required'=> true,
                'attr' => [
                    'placeholder' =>'Votre numero de Télephone'
                ]
            ])
            ->add('address', TextType::class,[
                'label'=>'adresse',
                'required'=> true,
                'attr' => [
                    'placeholder' =>'Votre Adresse'
                ]
            ])
            ->add('postal',IntegerType::class,[
                'label'=>'Code Postal',
                'required'=> true,
                'attr' => [
                    'placeholder' =>' Votre code Postal'
                ]
            ] )

            ->add('city', TextType::class,[
                'label'=>'Ville',
                'required'=> true,
                'attr' => [
                    'placeholder' =>'Votre Ville'
                ]
            ])

            ->add('country', CountryType::class,[
                'label'=>'Pays',
                'required'=> true,
                'attr' => [
                    'placeholder' =>'Pays'
                ]
            ])


            ->add('submit', SubmitType::class, [
                'label'=> 'Valider',
    
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}
