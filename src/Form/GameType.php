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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom du jeu',
                'constraints' => [
                new Length([
                    'max' => 100,
                    'maxMessage' => 'Le nom du jeu ne peut pas dépasser 100 caractères',
                ]),
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
        ]) 
            ->add('rental_price', IntegerType::class, [
                'label' => 'Prix du jeu à la location',
                'constraints' => [
                    new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
                ]
            ])
            ->add('selling_price', IntegerType::class, [
                'label' => 'Prix du jeu à la vente',
                'constraints' => [
                    new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
                ]
            ])
            ->add('category') // voir la contrainte de EntityGame
            ->add('age', TextType::class, [
                'label' => 'Tranche d\'âge',
                'constraints' => [
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nombre de caractères ne peut pas dépasser 50',
                ]),
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
            ])
            ->add('nb_players', TextType::class, [
                'label' => 'Nombre de joueurs',
                'constraints' => [
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nombre de caractères ne peut pas dépasser 50',
                ]),
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
            ])
            ->add('play_time', TextType::class, [
                'label' => 'Durée d\'une partie',
                'constraints' => [
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nombre de caractères ne peut pas dépasser 50',
                ]),
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
            ])
            ->add('material', TextType::class, [
                'label' => 'Matériaux du jeu',
                'constraints' => [
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nombre de caractères ne peut pas dépasser 50',
                ]),
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
            ])
            ->add('description', TextType::class, [
                'label' => 'Description du jeu',
                'constraints' => [
                new Length([
                    'max' => 50,
                    'maxMessage' => 'Le nombre de caractères ne peut pas dépasser 50',
                ]),
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
            ])
            ->add('stock', IntegerType::class, [
                'label' => 'Nombre d\'exemplaires',
                'constraints' => [
                new NotBlank([ 'message' => 'Ce champ ne peut être vide'])
            ]
            ])
            ->add('grade')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
