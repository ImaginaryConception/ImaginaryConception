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
                'required' => true,
            ])
            ->add('clientAddress', TextType::class, [
                'label' => 'Adresse postale / Siège social',
                'required' => true,
            ])
            ->add('clientEmail', EmailType::class, [
                'label' => 'Email de contact',
                'required' => true,
            ])
            ->add('clientSiret', TextType::class, [
                'label' => 'N° SIRET ou équivalent',
                'required' => false,
            ])

            // Project Information
            ->add('projectSubject', TextType::class, [
                'label' => 'Objet du projet',
                'required' => true,
            ])
            ->add('projectInclusions', TextareaType::class, [
                'label' => 'Éléments inclus',
                'required' => true,
            ])
            ->add('selectedPlan', ChoiceType::class, [
                'label' => 'Plan choisi',
                'choices' => [
                    'Pack Essentiel' => 'essential',
                    'Pack Business' => 'business',
                    'Pack Premium' => 'premium',
                ],
                'required' => true,
            ])
            ->add('monthlyMaintenance', CheckboxType::class, [
                'label' => 'Maintenance mensuelle',
                'required' => false,
            ])

            // Duration and Deadline
            ->add('startDate', DateType::class, [
                'label' => 'Date de début',
                'widget' => 'single_text',
                'required' => true,
            ])
            ->add('estimatedDuration', TextType::class, [
                'label' => 'Durée estimée',
                'required' => true,
            ])
            ->add('deliveryDeadline', DateType::class, [
                'label' => 'Date de livraison',
                'widget' => 'single_text',
                'required' => true,
            ])

            // Payment Information
            ->add('totalPrice', NumberType::class, [
                'label' => 'Prix total (€)',
                'required' => true,
            ])
            ->add('fullPayment', CheckboxType::class, [
                'label' => 'Paiement 100%',
                'required' => true,
            ])
            ->add('paymentMethod', ChoiceType::class, [
                'label' => 'Mode de paiement',
                'choices' => [
                    'Virement bancaire' => 'bank_transfer',
                    'PayPal' => 'paypal',
                    'Carte bancaire' => 'credit_card',
                ],
                'required' => true,
            ])
            ->add('bankDetails', TextareaType::class, [
                'label' => 'RIB',
                'required' => true,
                'data' => 'IBAN: FR76 XXXX XXXX XXXX XXXX XXXX XXX\nBIC: XXXXXXXX', // À remplacer par vos vraies coordonnées bancaires
            ])

            // Deliverables
            ->add('deliverables', TextareaType::class, [
                'label' => 'Livrables',
                'required' => true,
            ])
            ->add('exclusions', TextareaType::class, [
                'label' => 'Éléments non inclus',
                'required' => true,
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