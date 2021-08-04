<?php

namespace App\Form;

use App\Entity\Client;
use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReservationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroReservation')
            ->add('dateReservation')
            ->add('dateFinReservation')
            ->add('nombreDePersonne')
            ->add('client', EntityType::class, [
                'class' => Client::class,
                'choice_label' => 'email'
            ])
            ->add('chambre')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
