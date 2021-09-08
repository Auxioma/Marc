<?php

namespace App\Form\Users;

use App\Entity\Users;
use App\Entity\Category;
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
            ->add('category', EntityType::class, [
                'mapped' => false,
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $er) {
                    return $er->createQueryBuilder('u')
                    ->andWhere('u.Parent = :val')
                    ->setParameter('val', '1');
                }
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
            ->add('GooglePlaceID', TextType::class, [
                'label' => false,
                'mapped' => false,
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
            ->add('LundiMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('LundiMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('LundiAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('LundiAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('MardiMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MardiMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MardiAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MardiAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('MercrediMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MercrediMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MercrediAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MercrediAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('JeudiMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('JeudiMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('JeudiAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('JeudiAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('VendrediMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('VendrediMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('VendrediAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('VendrediAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('SamediMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('SamediMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('SamediAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('SamediAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('DimancheMatinOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('DimancheMidiFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('DimancheAPMOuverture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('DimancheAPMFermeture', TimeType::class, [
                'mapped' => false,
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('image', FileType::class, [
                'label' => false,
                'mapped' => false,
                'attr' => [
                    'class' => 'upload tooltip top'
                ]
            ])
        ;

       $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event){
                $form = $event->getForm();
                $idd = $event->getForm()->getData()->getId();

                $form->getParent()->add('sub_category', EntityType::class, [
                    'class' => Category::class,
                    'mapped' => false,
                    'query_builder' => function (CategoryRepository $er) use ($idd)  {
                        return $er->createQueryBuilder('u')
                        ->andWhere('u.Parent = :val')
                        ->setParameter('val', $idd);
                    }
                ]);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
