<?php

namespace App\Form;

use App\Entity\Pharmacien;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PharmacienType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('id_pharmacie')
            ->add('siren')
            ->add('name')
            ->add('email')
            ->add('address')
            ->add('phone')
            ->add('id_ville')
            ->add('id_proprietaire')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Pharmacien::class,
        ]);
    }
}
