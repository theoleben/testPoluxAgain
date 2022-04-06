<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('prenom')
        ->add('nom')
        ->add('plainPassword',PasswordType::class,[
            'mapped' => false,
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter a password',
                ]),
                new Length([
                        'min' => 4,
                        'minMessage' => 'Votre mot de passe doit comporter au moins {{ limit }} caractères.',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
        ] )
        ->add('date_naissance', BirthdayType::class, [
            'widget' => "single_text",
        ])
        ->add('email')
            ->add('address' , TextareaType::class, [
                'label_format' => 'Adresse de Livraison',
                // 'help' => 'Veuillez renseigner votre adresse pour la livraison.',
            ])
            ->add('zip_code', null, [
                // 'help' => 'Veuillez renseigner votre code postal pour la livraison.',
            ])
            ->add('city', null, [
                // 'help' => 'Veuillez renseigner votre ville pour la livraison.',
            ])
            ->add('phone', TextareaType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => "/^[0-9\-\(\)\/\+\s]*$/",
                        // 'message' => "Votre numéro de téléphone n'est pas valide.",
                        
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
