<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', options: [            
                'attr' => [
                    'class' => 'edit', // Clase CSS para el campo select
                ],
            ])
            ->add('name', options: [
                'attr' => [
                    'class' => 'edit', // Clase CSS para el campo select
                ],
            ])
            ->add('nick_name', options: [
                'attr' => [
                    'class' => 'edit', // Clase CSS para el campo select
                ],
            ]);

/*             ->add('roles', ChoiceType::class, [
                'multiple' => true,
                'expanded' => true,
                'choices' => User::getRolesForForm()
                ]) */
            /* ->add('password'); */
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
