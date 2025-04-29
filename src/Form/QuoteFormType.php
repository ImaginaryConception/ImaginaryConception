<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Client Information
            ->add('clientName', TextType::class, [
                'label' => 'Prénom et nom du client / Raison sociale',
                'required' => false,
            ])
            ->add('clientEmail', EmailType::class, [
                'label' => 'Adresse e-mail du client',
                'required' => false,
            ])
            ->add('clientPhone', TelType::class, [
                'label' => 'Numéro de téléphone du client',
                'required' => false,
            ])

            // Project Information
            ->add('websiteType', ChoiceType::class, [
                'label' => 'Type du site',
                'choices' => [
                    'Site vitrine' => 'Site vitrine',
                    'E-commerce' => 'E-commerce',
                    'Portfolio' => 'Portfolio',
                    'Blog' => 'Blog',
                    'Autre' => 'Autre',
                ],
                'required' => false,
            ])
            ->add('estimatedPages', NumberType::class, [
                'label' => 'Nombre de pages estimées',
                'required' => false,
                'attr' => ['min' => 1],
            ])
            ->add('graphicCharter', CheckboxType::class, [
                'label' => 'Charte graphique',
                'required' => false,
            ])
            ->add('specificFunctions', TextareaType::class, [
                'label' => 'Fonctions spécifiques',
                'required' => false,
            ])
            ->add('deadline', DateType::class, [
                'label' => 'Deadline',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('totalPrice', NumberType::class, [
                'label' => 'Prix total',
                'required' => false,
                'attr' => ['min' => 0],
            ])
            ->add('selectedPlan', ChoiceType::class, [
                'label' => 'Plan choisi',
                'choices' => [
                    'Starter' => 'starter',
                    'Business' => 'business',
                    'Premium' => 'premium',
                    'Custom' => 'custom',
                ],
                'required' => false,
            ])
            ->add('customInclusions', TextareaType::class, [
                'label' => 'Inclusions personnalisées (pour plan Custom uniquement)',
                'required' => false,
            ])
            ->add('additionalInfo', TextareaType::class, [
                'label' => 'Informations additionnelles',
                'required' => false,
            ])
            ->add('isEnglish', CheckboxType::class, [
                'label' => 'Version anglaise',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => null,
            'csrf_protection' => true,
        ]);
    }
}