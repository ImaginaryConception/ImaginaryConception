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
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname_lastname', TextType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'Full name',
            ],
            'constraints' => [
                new Length([
                    'min' => 3,
                    'minMessage' => 'This field must contain at least {{ limit }} characters!',
                    'max' => 100,
                    'maxMessage' => 'This field must not exceed {{ limit }} characters!',
                ]),
            ],
        ])
        ->add('email', EmailType::class, [
            'label' => false,
            'attr' => [
                'placeholder' => 'E-mail address *',
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
                'placeholder' => 'Object *',
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
                'placeholder' => 'Message *',
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
        ->add('recaptcha', ReCaptchaType::class)
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
