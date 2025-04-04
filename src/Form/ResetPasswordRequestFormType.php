<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ResetPasswordRequestFormType extends AbstractType
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
                    'message' => 'Please enter your email address.'
                ]),
                new Email([
                    'message' => 'Your email address ({{ value }}) is invalid!',
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
