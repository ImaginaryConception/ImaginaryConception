<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'options' => [
                    'attr' => [
                        'autocomplete' => 'new-password',
                        'placeholder' => 'New Password *',
                    ],
                ],
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'Please enter a password.',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'Your password must be at least {{ limit }} characters!',
                            'max' => 4096,
                            'maxMessage' => 'Your password must not exceed {{ limit }} characters!',
                        ]),
                        new Regex([
                            'pattern' => "/(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*[ !\"\#\$%&\'\(\)*+,\-.\/:;<=>?@[\\^\]_`\{|\}~])^.{8,4096}$/u",
                            'message' => 'Your password must contain a lowercase letter, an uppercase letter, a number and a special character.',
                        ]),
                    ],
                    'label' => false,
                ],
                'second_options' => [
                    'label' => false,
                    'attr' => [
                        'placeholder' => 'Repeat password *',
                    ],
                ],
                'invalid_message' => 'Password fields must match.',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Send',
                'attr' => [
                    'class' => 'btn-save d-flex justify-content-center',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
