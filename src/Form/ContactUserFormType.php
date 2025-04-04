<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactUserFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Your email address *',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your email address.',
                    ]),
                    new Email([
                        'message' => 'Your email address ({{ value }}) is invalid!',
                    ]),
                ],
            ])
            ->add('object', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Object of the message *',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in the subject of the message.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The subject of the message must contain at least {{ limit }} characters!',
                        'max' => 100,
                        'maxMessage' => 'The subject of the message must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('message', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Message content *',
                    'rows' => '5',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter your message.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Your message must contain at least {{ limit }} characters!',
                        'max' => 20000,
                        'maxMessage' => 'Your message must not exceed {{ limit }} characters!',
                    ]),
                ],
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