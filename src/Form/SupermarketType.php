<?php

namespace App\Form;

use App\Entity\Supermarket;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupermarketType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('address')
            ->add('phoneNumber')
            ->add('email')
            ->add('openedAt')
            ->add('closedAt')
            ->add('description')
            ->add('rating')
            ->add('isOpened')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Supermarket::class,
        ]);
    }
}
