<?php

namespace App\Form;

use App\Entity\Review;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReviewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrez votre nom *'
                ]
            ])
            ->add('rating', IntegerType::class, [
                'label' => 'Note',
                'label_attr' => [
                    'class' => 'me-2 fw-bold',
                ],
                'attr' => [
                    'class' => 'rating-input',
                    'min' => 1,
                    'max' => 5
                ]
            ])
            ->add('content', TextareaType::class, [
                'label' => 'Votre avis',
                'attr' => [
                    'class' => 'form-control',
                    'rows' => 4,
                    'placeholder' => 'Partagez votre expérience'
                ]
            ])
            ->add('recaptcha', ReCaptchaType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn-dark border-0 px-4 py-2 mt-3 w-100 transition-all hover:opacity-80',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Review::class,
        ]);
    }
}