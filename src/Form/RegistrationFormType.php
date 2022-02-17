<?php

namespace App\Form;

use App\Entity\Users;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom'
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom'
            ])
            ->add('address', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Adresse'
            ])
            ->add('zipcode', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Code postal'
            ])
            ->add('city', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ville'
            ])
            ->add('RGPDConsent', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
                'label' => 'En m\'inscrivant à ce site j\'accepte...'
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
                'label' => 'Mot de passe'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
