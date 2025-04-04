<?php

namespace App\Form;

use App\Entity\Website;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class WebsiteRequestFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname_firstname', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Nom et prénom *',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre nom et prénom.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Ce champ doit contenir un minimul de {{ limit }} caractères!',
                        'max' => 1000,
                        'maxMessage' => 'Ce champ ne doit pas dépasser {{ limit }} caractères!',
                    ]),
                ],
            ])
            ->add('websiteType', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Type de site internet *',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir le type de site internet souhaité.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Ce champ doit contenir un minimul de {{ limit }} caractères!',
                        'max' => 2000,
                        'maxMessage' => 'Ce champ ne doit pas dépasser {{ limit }} caractères!',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Votre adresse e-mail *',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez saisir votre adresse e-mail.',
                    ]),
                    new Email([
                        'message' => 'Votre adresse e-mail ({{ value }}) est invalide!',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Demander un devis',
                'attr' => [
                    'class' => 'btn-save d-flex justify-content-center',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Website::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
