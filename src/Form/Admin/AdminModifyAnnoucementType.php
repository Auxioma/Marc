<?php

namespace App\Form\Admin;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdminModifyAnnoucementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('EndAt', DateTimeType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'widget' => 'single_text',
            ])
            ->add('submit', SubmitType::class, [
                'attr' => [
                    'class' => 'btn btn-sm btn-primary',
                ], 
                'label' => 'Modification de la date de fin de diffusion de l\'annonce'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
