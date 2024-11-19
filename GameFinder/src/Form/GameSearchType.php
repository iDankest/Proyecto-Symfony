<?php

namespace App\Form;

use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameSearchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genre', EntityType::class, [
                'class' => Genre::class,
                'choice_label' => 'name', // Ajusta según el campo que desees mostrar
                'placeholder' => 'Selecciona un género',
                'multiple' => false, // Cambia a true si deseas múltiples selecciones
                'label' => ' ',
                'attr' => [
                    'class' => 'searcher', // Clase CSS para el campo select
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}