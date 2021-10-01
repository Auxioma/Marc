<?php

namespace App\Form\Users;

use App\Entity\Users;
use App\Entity\Category;
use App\Form\DeliveryType;
use App\Form\HorairesType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormEvent;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
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
            ->add('civilite', ChoiceType::class,
                [
                    'choices' => ['Monsieur' => "Mr", 'Madame' => 'Mme'],
                    'expanded' => true,
                    'label' => false,
                    'data' => "Mr",
                    'attr' => [
                        'class' => 'radioButtons',
                    ],
                ]
            )
            ->add('dateNaissance', DateType::class,
                [
                    'label' => false,
                    'widget' => 'single_text',
                    'format' => 'yyyy-MM-dd',
                    'attr' => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('phoneNumber', TelType::class, [
                    'label' => false,
                    'attr' => [
                        'class' => 'form-control border-start-0',
                    ]
                ]
            )
            ->add('afficheTelephone', ChoiceType::class,
                [
                    'choices' => ['OUI' => "1", 'NON' => '0'],
                    'label' => false,
                    'attr' => ['class' => 'form-control form-select']
                ])
            ->add('Compagny', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'ZIMBOO'
                ],
            ])
            ->add('GooglePlaceID', TextType::class, [
                'label' => false,
                'mapped' => false,
                'data' => $options['data']->getAddress(),
                'attr' => [
                    'placeholder' => 'Votre adresse'
                ],
            ])
            ->add('Address', HiddenType::class)
            ->add('CodePost', HiddenType::class)
            ->add('Department', HiddenType::class)
            ->add('Latitude', HiddenType::class)
            ->add('Longitude', HiddenType::class)
            ->add('City', HiddenType::class)
            ->add('Url', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'https://'
                ],
            ])


            ->add('image', FileType::class, [
                'required' => $options['data'] and !$options['data']->getId(),
                'mapped' => false,
                'label' => false,
                'attr' => [
                    'class' => 'upload'
                ]
            ])
            ->add('horaires', HorairesType::class)
            ->add('delivery', DeliveryType::class)
        ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}