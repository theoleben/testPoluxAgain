<?php

namespace App\Form;

use App\Entity\Discount;
use App\Entity\Subscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Titre'
            ])
            ->add('games_number')
            ->add('price')
            ->add('new_duration')
            ->add('shipping_cost')
            ->add('description')
            ->add('discount', EntityType::class, [
                'class' => Discount::class,
                'choice_label' => 'type', // On choisit le champ qui sera affiché dans le select
                'placeholder' => "",
                'label' => 'Réduction'
            ] )
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
        ]);
    }
}
