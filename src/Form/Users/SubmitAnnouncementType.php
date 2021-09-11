<?php

namespace App\Form\Users;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubmitAnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Entré votre promotion',
                ],
                'label' => false,
            ])
            ->add('Discount', TextType::class, [
                'attr' => [
                    'placeholder' => '20',
                ],
                'label' => false,
            ])
            ->add('ShortDescription', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Decrivez votre titre en 25 caractère',
                ],
                'label' => false,
            ])
            ->add('LongDescription', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Longue description',
                ],
                'label' => false,
            ])
            ->add('YouTube', UrlType::class, [
                'attr' => [
                    'placeholder' => 'https://',
                ],
                'label' => false,
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
