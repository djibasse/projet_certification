<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Chambre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChambreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroChambre')
            ->add('etage')
            ->add('description')
            ->add('prix')
            ->add('chauffage')
            ->add('nombreDeLits')
            ->add('salleDeBain')
            ->add('etat')
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'libele'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Chambre::class,
        ]);
    }
}
