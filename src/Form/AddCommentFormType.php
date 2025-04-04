<?php

namespace App\Form;

use App\Entity\Comment;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddCommentFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('content', TextareaType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Enter your comment... *',
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please fill in your comment.',
                    ]),
                    new Length([
                        'min' => 3,
                        'minMessage' => 'The comment must contain at least {{ limit }} characters!',
                        'max' => 10000,
                        'maxMessage' => 'The comment should not exceed {{ limit }} characters!',
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
            'data_class' => Comment::class,
            'attr' => [
                'novalidate' => 'novalidate',
            ],
        ]);
    }
}
