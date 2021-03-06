<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('PhoneNumber', TelType::class, [
                'attr' => [
                    'class'         =>  'input-text',
                    'placeholder'   =>  '+41 00 000 00 00',
                ],
                'label'             =>  false
            ])
            ->add('email', EmailType::class, [
                'attr' => [
                    'class'         =>  'input-text',
                    'placeholder'   =>  'Entrez votre Email',
                ],
                'label'             =>  false
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped'            => false,
                'label'             =>  false,
                'constraints'       => [
                    new IsTrue([
                        'message'   => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped'            => false,
                'attr'              => [
                    'autocomplete'  => 'new-password',
                    'class'         =>  'input-text',
                    'placeholder'   =>  'Votre mot de passe',
                ],
                'label'             =>  false,
                'constraints'       => [
                    new NotBlank([
                        'message'   => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
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
