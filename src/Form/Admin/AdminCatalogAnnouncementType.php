<?php

namespace App\Form\Admin;

use App\Entity\PackageAdTextual;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminCatalogAnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'control-form',    
                ], 
                'label' => false,
            ])
            ->add('nbrDays', TextType::class, [
                'attr' => [
                    'class' => 'control-form',    
                ], 
                'label' => false,
            ])
            ->add('pricePerDay', TextType::class, [
                'attr' => [
                    'class' => 'control-form',    
                ], 
                'label' => false,
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-lg btn-primary',  
                ], 
                'label' => 'Modification'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => PackageAdTextual::class,
        ]);
    }
}
