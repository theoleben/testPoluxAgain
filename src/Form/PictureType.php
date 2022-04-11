<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Picture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class PictureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // Ce code est placé pour pouvoir download a picture
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
                ]),
                new NotBlank([
                    'message' => 'Veuillez choisir une photo',
                ])
            ] 
            ])
            ->add('game', EntityType::class, [
                'class' => Game::class,
                'choice_label' => 'title',
                'label' => 'Jeu à associer à la photo',
                'required' => true,
                'constraints' => [
                    new NotBlank([ 'message' => 'Veuillez sélectionner un jeu à associer à cette photo'])
                ]
                ]);
    }
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Picture::class,
        ]);
    }
}
