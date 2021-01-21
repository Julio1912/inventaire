<?php

namespace App\Form;

use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModifierUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Name')
            ->add('Username')
            ->add('Roles' , CollectionType::class , [
                'entry_type' =>ChoiceType::class , 
                    'entry_options' =>[
                        'choices'=>[
                            'ROLE ADMIN' => 'ROLE_ADMIN' , 
                            'ROLE SUPER ADMIN' => 'ROLE_SUPER_ADMIN' , 
                            'ROLE SECRETAIRE' => 'ROLE_SECRETAIRE'
                        ],
                    
                    ],
            ])

            // ->add('Roles' , ChoiceType::class , [
            //     'choices' => [
            //         'ROLE ADMIN' => 'ROLE_ADMIN' , 
            //         'ROLE SUPER ADMIN' => 'ROLE_SUPER_ADMIN' , 
            //         'ROLE SECRETAIRE' => 'ROLE_SECRETAIRE'
            //     ],
            //     'expanded' =>false , 
            //     'multiple' => true
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
