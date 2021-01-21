<?php

namespace App\Form;

use App\Entity\TBase;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\TCode;

use App\Entity\TEmplacement;

// use Symfony\Component\Form\Extension\Core\Type\EntityType;

class TBaseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('DateReception')
            ->add('Designation')
            ->add('NumerosSerie')
            ->add('Identification')
            ->add('DateAffectation')
            ->add('CodeComplet' , EntityType::class , [
                'class' => TCode::class, 
                'query_builder' => function (EntityRepository $er)
                {
                    return $er->createQueryBuilder('u')->orderBy('u.id' , 'DESC');
                } , 
                'choice_label' => 'CodeComplet'
            ])
            ->add('emplacement' , EntityType::class , [
                'class' =>TEmplacement::class ,
                'query_builder' => function (EntityRepository $emplacement)
                {
                    return $emplacement->createQueryBuilder('u')->orderBy('u.id' , 'DESC'); 
                } , 
                'choice_label' => 'Emplacement'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TBase::class,
        ]);
    }
}
