<?php

namespace App\Form;

use App\Entity\Games;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GamesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('photo')
            ->add('title')
            ->add('description')
            ->add('release_date')
            ->add('assessment')
            ->add('genre_id')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Games::class,
        ]);
    }
}
