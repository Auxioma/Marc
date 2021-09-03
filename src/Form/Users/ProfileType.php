<?php

namespace App\Form\Users;

use App\Entity\Users;
use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('category', EntityType::class, [
                'mapped' => false,
                'class' => Category::class,
            ])
            ->add('Name', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Doe'
                ],
            ])
            ->add('FirstName', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'John'
                ],
            ])
            ->add('Compagny', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'ZIMBOO'
                ],
            ])
            ->add('Address', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse'
                ],
            ])
            ->add('Url', UrlType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'https://'
                ],
            ])
            ->add('LundiMatinOuverture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('LundiMidiFermeture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('LundiAPMOuverture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('LundiAPMFermeture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('MardiMatinOuverture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('MardiMidiFermeture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('MardiAPMOuverture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
            ->add('MardiAPMFermeture', TimeType::class, [
                'mapped' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
