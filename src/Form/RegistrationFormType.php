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

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('prenom')
            ->add('nom')
            ->add('dateNaissance', BirthdayType::class, [
                'mapped' => false,
                'widget' => "single_text",
            ])
            ->add('email')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    // new Length([
                    //     'min' => 6,
                    //     'minMessage' => 'Your password should be at least {{ limit }} characters',
                    //     // max length allowed by Symfony for security reasons
                    //     'max' => 4096,
                    // ]),
                    new Regex([
                        'pattern' => "/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[-+!*$@%_])([-+!*$@%_\w]{6,15})$/",
                        'message' => "Le mot de passe n'est pas valide.",
                        
                    ])
                    //Regex: ^ début de la chaine de caractères, $ fin de la chaine \d = n'importe quel chiffre, entre crochet ce sont les caractères spéciaux , \w n'importe quel caractère dans un mot, {8,15} la longeur du mdp doit être compris entre 8 et 15 caractères, ?=. ce groupe de caractères peut être n'importe où ds le mdp
                    // pour tester regex: regex101.com
                ],
                'label' => 'Mot de Passe',
                'help' => "Votre mot de passe doit comporter au moins 1 majuscule, 1 minuscule, 1 chiffre et un caractère spécial (-+!*$@%_), et entre 6 et 15 caractères."
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
