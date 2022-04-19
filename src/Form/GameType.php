<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
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
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name', 
                'multiple' => true,
                'expanded' => false,
                'label' => 'Catégorie',
                'help' => 'Si aucune catégorie disponible, veuillez en créer une via "Ajouter une catégorie"',
                'constraints' => [
                    new NotBlank([ 'message' => 'Veuillez sélectionner une catégorie'])
                ]
            ]) // voir la contrainte de EntityGame
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
                new NotBlank([ 'message' => 'Ce champ ne peut être vide !'])
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
                    'max' => 300,
                    'maxMessage' => 'Le nombre de caractères ne peut pas dépasser 300',
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
            ->add('name', FileType::class, [
                'mapped' => false,
                'required' => false,
                'label' => 'Photo', 
                'help' => 'N\'oubliez pas de choisir une photo',
                'constraints' => [
                    new File([
                        'mimeTypes' => [ "image/jpeg", "image/png", "image/gif"],
                        "mimeTypesMessage" => "Les formats autorisés sont gif, png, jpg",
                        'maxSize' => "2048k",
                        'maxSizeMessage' => 'Le fichier ne peut pas peser plus de 2Mo'
                    ])
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
