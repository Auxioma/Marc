<?php

namespace App\Form\Users;

use App\Entity\Announcement;
use App\Entity\Category;
use App\Entity\PriceAnnouncement;
use App\Form\PictureType;
use App\Repository\CategoryRepository;
use App\Repository\PriceAnnouncementRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
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
            ->add('Category', EntityType::class, [
                'attr' => [
                    'class' => 'utf-chosen-select-single-item1'
                ],
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.Parent IS NULL');
                },
            ])
            ->add('subCategory', EntityType::class, [
                'attr' => [
                    'class' => 'utf-chosen-select-single-item1'
                ],
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->where('u.Parent IS NOT NULL');
                },
            ])

            ->add('Title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Ex: Un acheté un offert',
                    'data-unit' => '0/20',
                    'maxlength' => '20',
                ],
                'label' => false,
                'required' => false
            ])
            ->add('titlediscount', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Sur tout le magasin',
                    'maxlength' => '20',
                    'data-unit' => '0/20',
                ],
                'label' => false,
                'required' => false

            ])
            ->add('Discount', IntegerType::class, [
                'attr' => [
                    'class' => 'form-control p-1',
                    'placeholder' => '00',
                    'min' => '0',
                    'max' => '100',
                    'data-unit' => '%'
                ],
                'label' => false,
                'required' => false,
            ])
            ->add('ShortDescription', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Decrivez votre titre en 25 caractère',
                ],
                'label' => false,
            ])
            ->add('LongDescription', CKEditorType::class, [
                'required' => true,
                'config' => array(
                    'uiColor' => '#ffffff',
                    //...
                )]
            )

            ->add('Picture',CollectionType::class, array(
                'entry_type'   		=> PictureType::class,
                'prototype'			=> true,
                'allow_add'			=> true,
                'allow_delete'		=> true,
                'by_reference' 		=> false,
                'required'			=> false,
                'label'			=> false,
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }
}
