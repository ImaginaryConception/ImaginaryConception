<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InvoiceFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Client Information
            ->add('clientName', TextType::class, [
                'label' => 'Full Name / Company Name',
                'required' => false,
            ])
            ->add('clientAddress', TextareaType::class, [
                'label' => 'Postal Address / Registered Office',
                'required' => false,
            ])
            ->add('clientEmail', EmailType::class, [
                'label' => 'Contact Email',
                'required' => false,
            ])
            ->add('clientSiret', TextType::class, [
                'label' => 'SIRET Number (if applicable)',
                'required' => false,
            ])
            
            // Invoice Information
            ->add('invoiceDate', DateType::class, [
                'label' => 'Invoice Date',
                'widget' => 'single_text',
                'required' => false,
            ])
            ->add('invoiceNumber', TextType::class, [
                'label' => 'Invoice Number',
                'required' => false,
            ])
            ->add('invoiceTitle', TextType::class, [
                'label' => 'Subject / Title',
                'required' => false,
            ])
            
            // Service Details
            ->add('serviceDescription', TextareaType::class, [
                'label' => 'Service Description',
                'required' => false,
            ])
            ->add('quantity', NumberType::class, [
                'label' => 'Quantity',
                'required' => false,
                'scale' => 0,
                'attr' => ['min' => 1],
            ])
            ->add('unitPrice', MoneyType::class, [
                'label' => 'Unit Price (excl. VAT)',
                'currency' => 'EUR',
                'required' => false,
            ])
            
            // Payment Terms
            ->add('paymentTerms', ChoiceType::class, [
                'label' => 'Payment Terms',
                'choices' => [
                    'Immediate Payment' => 'immediate',
                    'Upon Receipt' => 'upon_receipt',
                    '50% Upfront / 50% Upon Delivery' => 'split',
                ],
                'required' => false,
            ])
            ->add('latePenalty', ChoiceType::class, [
                'label' => 'Include Late Payment Penalty',
                'choices' => [
                    'Yes' => true,
                    'No' => false,
                ],
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