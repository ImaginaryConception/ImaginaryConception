<?php

namespace App\Form;

use App\Entity\Game;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddGameFormType extends AbstractType
{

    private $allowedMimeTypes = [
        'jpg' => 'image/jpeg',
        'png' => 'image/png',
    ];

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => false,
                'empty_data' => 'Not specified',
                'attr' => [
                    'placeholder' => 'Game title *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in the title.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The title must contain at least {{ limit }} characters!',
                        'max' => 2000,
                        'maxMessage' => 'The title must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('buylink', TextType::class, [
                'label' => false,
                'empty_data' => 'Not specified',
                'attr' => [
                    'placeholder' => 'Buying link *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in the link.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The link must contain at least {{ limit }} characters!',
                        'max' => 20000,
                        'maxMessage' => 'The link must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('trailer', TextType::class, [
                'label' => false,
                'empty_data' => 'Not specified',
                'attr' => [
                    'placeholder' => 'Trailer link *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in the link.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The link must contain at least {{ limit }} characters!',
                        'max' => 30000,
                        'maxMessage' => 'The link must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('price', TextType::class, [
                'label' => false,
                'empty_data' => 'Not specified',
                'required' => false,
                'attr' => [
                    'placeholder' => 'Game price *',
                ],
                'constraints' => [
                    new Length([
                        'min' => 1,
                        'minMessage' => 'The price must contain at least {{ limit }} characters!',
                        'max' => 150,
                        'maxMessage' => 'The price must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('genre', TextType::class, [
                'label' => false,
                'empty_data' => 'Not specified',
                'attr' => [
                    'placeholder' => 'Game category *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in the category.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The category must contain at least {{ limit }} characters!',
                        'max' => 500,
                        'maxMessage' => 'The category must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('image', FileType::class, [
                'label' => false,
                'required' => true,
                'data_class' => null,
                'attr' => [
                    'accept' => implode(', ', $this->allowedMimeTypes),
                    'novalidate' => 'novalidate',
                ],
                'constraints' => [
                    new File([
                        'maxSize' => '10M',
                        'mimeTypes' => $this->allowedMimeTypes,
                        'mimeTypesMessage' => 'The image must be JPG or PNG only!',
                        'maxSizeMessage' => 'File too large ({{ size }} {{ suffix }}). The maximum allowed size is {{ limit }}{{ suffix }}',
                    ]),
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => false,
                'empty_data' => 'Not specified',
                'attr' => [
                    'placeholder' => 'Description of the game *',
                ],
                'required' => true,
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in the description.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The description must contain at least {{ limit }} characters!',
                        'max' => 30000,
                        'maxMessage' => 'The description must not exceed {{ limit }} characters!',
                    ]),
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Add',
                'attr' => [
                    'class' => 'btn-save d-flex justify-content-center',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
