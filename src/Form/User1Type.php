<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class User1Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            
            ->add('prenom')
            ->add('nom')
            ->add('email')
            ->add('password', PasswordType::class, [
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    // new Regex([
                    //     'pattern' => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,15})$/",
                    //     'message' => "Le mot de passe n'est pas valide.",
                        
                    // ])
                ],
                'label' => 'Mot de Passe',
                'help' => 'Le mot de passe doit contenir au moins 6 caractères, dont au moins une majuscule, une minuscule, un chiffre et un caractère spécial.',
            ])
            ->add('address', TextareaType::class, [
                'label' => "adresse",
            ])
            ->add('zip_code', IntegerType::class, [
                'label' => "Code Postal",
            ])
            ->add('city', TextType::class, [
                'label' => "Ville",
            ])
            ->add('phone', IntegerType::class, [
                'label' => "Téléphone",
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
