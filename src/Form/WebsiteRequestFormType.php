<?php

namespace App\Form;

use App\Entity\Website;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Type;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use VictorPrdh\RecaptchaBundle\Form\ReCaptchaType;

class WebsiteRequestFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Prénom *',
                    'class' => 'text-black',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre prénom.'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre prénom doit contenir au minimum {{ limit }} caractères !',
                        'max' => 100,
                        'maxMessage' => 'Votre prénom ne doit pas dépasser {{ limit }} caractères !',
                    ]),
                ],
            ])
            ->add('lastname', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Nom *',
                    'class' => 'text-black',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre nom.'
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Votre nom doit contenir au minimum {{ limit }} caractères !',
                        'max' => 150,
                        'maxMessage' => 'Votre nom ne doit pas dépasser {{ limit }} caractères !',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Adresse e-mail *',
                    'class' => 'text-black',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre adresse e-mail.'
                    ]),
                    new Email([
                        'message' => 'Votre adresse e-mail ({{ value }}) est invalide !',
                    ]),
                ],
            ])
            ->add('phone', TelType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Numéro de téléphone *',
                    'class' => 'text-black',
                ],
                'required' => false,
                'constraints' => [
                    new Regex([
                        'pattern' => '/^\d+$/', // Seulement des chiffres
                        'message' => 'Veuillez entrer un numéro de téléphone valide (uniquement des chiffres).'
                    ]),
                    new NotBlank([
                        'message' => 'Veuillez renseigner votre numéro de téléphone.'
                    ]),
                ],
            ])
            ->add('companyName', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nom de l\'entreprise (facultatif)',
                    'class' => 'text-black',
                ]
            ])
            ->add('existingWebsite', UrlType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Lien vers un site existant (facultatif)',
                    'class' => 'text-black',
                ]
            ])
            ->add('type', ChoiceType::class, [
                'label' => 'Type de projet *',
                'required' => true,
                'choices'  => [
                    'Site vitrine' => 'Site vitrine',
                    'E-commerce' => 'E-commerce',
                    'Portfolio' => 'Portfolio',
                    'Blog' => 'Blog',
                    'Autre' => 'Autre',
                ],
                'attr' => [
                    'novalidate' => 'novalidate',
                    'class' => 'text-black',
                ],
                'label_attr' => [
                    'class' => 'text-light text-center',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de préciser le type de projet que vous souhaitez.'
                    ]),
                ],
            ])
            ->add('estimatedPages', TextType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'placeholder' => 'Nombre de pages estimé (facultatif)',
                    'class' => 'text-black',
                ],
                'constraints' => [
                    new Length([
                        'max' => 255,
                        'maxMessage' => 'Le nombre de pages estimé ne peut pas dépasser {{ limit }} caractères.',
                    ]),
                ],
            ])
            ->add('logo', ChoiceType::class, [
                'label' => 'Avez-vous une charte graphique ou un logo ? *',
                'required' => true,
                'choices'  => [
                    'Oui' => 'Oui',
                    'Non' => 'Non',
                ],
                'attr' => [
                    'novalidate' => 'novalidate',
                ],
                'label_attr' => [
                    'class' => 'text-light text-center',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de compléter ce champ.'
                    ]),
                ],
            ])
            ->add('likedWebsites', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Avez-vous des exemples de sites que vous aimez ? (facultatif)',
                    'class' => 'text-black',
                ],
                'required' => false,
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'La description doit contenir au moins {{ limit }} caractères !',
                        'max' => 30000,
                        'maxMessage' => 'La description ne doit pas dépasser {{ limit }} caractères !',
                    ]),
                ],
            ])
            ->add('specificFunctions', ChoiceType::class, [
                'label' => 'Fonctions spécifiques souhaitées',
                'choices' => [
                    'Formulaire de contact' => 'contact_form',
                    'Réservation' => 'reservation',
                    'Paiement en ligne' => 'online_payment',
                    'Galerie' => 'gallery',
                    'Autre' => 'other',
                ],
                'label_attr' => [
                    'class' => 'text-light text-center d-none d-md-block',
                ],
                'attr' => [
                    'novalidate' => 'novalidate',
                    'class' => 'text-center text-light',
                ],
                'expanded' => true,
                'multiple' => true,
                'required' => false,
            ])
            ->add('deadline', DateType::class, [
                'label' => false,
                'widget' => 'single_text',
                'required' => false,
                'html5' => true,
                'attr' => [
                    'placeholder' => 'Deadline souhaitée (falcultatif)',
                    'class' => 'text-black',
                ],
            ])
            ->add('estimatedBudget', IntegerType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'placeholder' => 'Budget estimé *',
                    'class' => 'text-black',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de renseigner votre budget estimé.'
                    ]),
                ],
            ])
            ->add('additionalInfo', TextareaType::class, [
                'label' => false,
                'required' => false,
                'attr' => [
                    'rows' => 5,
                    'placeholder' => 'Veuillez indiquer ici toutes les informations complémentaires que vous souhaitez nous communiquer. (facultatif)',
                    'class' => 'text-black',
                ],
            ])
            ->add('recaptcha', ReCaptchaType::class)
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer',
                'attr' => [
                    'class' => 'btn btn-outline-light btn-lg px-4 w-100 mt-3',
                ],
            ])
        ;
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