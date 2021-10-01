<?php

namespace App\Form;

use App\Entity\Horaires;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class HorairesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('LundiMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('LundiMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('LundiAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('LundiAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('MardiMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MardiMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MardiAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MardiAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('MercrediMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MercrediMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MercrediAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('MercrediAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('JeudiMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('JeudiMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('JeudiAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('JeudiAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('VendrediMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('VendrediMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('VendrediAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('VendrediAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('SamediMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('SamediMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('SamediAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('SamediAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])

            ->add('DimancheMatinOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('DimancheMidiFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('DimancheAPMOuverture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
            ->add('DimancheAPMFermeture', TimeType::class, [
                'required' => false,
                'widget' => 'single_text',
                'attr' => [
                    'label' => false,
                    'class' => 'horaire-control inputhoraire'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Horaires::class,
        ]);
    }
}
