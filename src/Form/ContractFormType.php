<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContractFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            // Client Information
            ->add('clientName', TextType::class, [
                'label' => 'Nom complet / Raison sociale',
                'required' => false,
            ])
            ->add('clientAddress', TextType::class, [
                'label' => 'Adresse postale / Siège social',
                'required' => false,
            ])
            ->add('clientEmail', EmailType::class, [
                'label' => 'Email de contact',
                'required' => false,
            ])
            ->add('clientSiret', TextType::class, [
                'label' => 'N° SIRET ou équivalent',
                'required' => false,
            ])

            // Project Information
            ->add('projectSubject', TextType::class, [
                'label' => 'Objet du projet',
                'required' => false,
            ])
            ->add('projectInclusions', TextareaType::class, [
                'label' => 'Éléments inclus',
                'required' => false,
            ])
            ->add('selectedPlan', ChoiceType::class, [
                'label' => 'Plan choisi',
                'choices' => [
                    'Pack Essentiel' => 'essential',
                    'Pack Business' => 'business',
                    'Pack Premium' => 'premium',
                ],
                'required' => false,
            ])
            ->add('monthlyMaintenance', CheckboxType::class, [
                'label' => 'Maintenance mensuelle',
                'required' => false,
            ])

            // Duration and Deadline
            ->add('startDate', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('estimatedDuration', TextType::class, [
                'label' => 'Durée estimée',
                'required' => false,
            ])
            ->add('deliveryDeadline', DateType::class, [
                'label' => 'Date de livraison',
                'widget' => 'single_text',
                'required' => false,
            ])

            // Payment Information
            ->add('totalPrice', NumberType::class, [
                'label' => 'Prix total (€)',
                'required' => false,
            ])
            ->add('fullPayment', CheckboxType::class, [
                'label' => 'Paiement 100%',
                'required' => false,
            ])
            ->add('paymentMethod', ChoiceType::class, [
                'label' => 'Mode de paiement',
                'choices' => [
                    'Virement bancaire' => 'Bank transfer',
                    'PayPal' => 'PayPal',
                    'Carte bancaire' => 'Bank card',
                ],
                'required' => false,
            ])
            ->add('bankDetails', TextareaType::class, [
                'label' => 'RIB',
                'required' => false,
                'data' => 'IBAN: FR76 XXXX XXXX XXXX XXXX XXXX XXX\nBIC: XXXXXXXX', // À remplacer par vos vraies coordonnées bancaires
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
            'csrf_protection' => true,
        ]);
    }
}