<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OrdersType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('deliveryAdresse', DeliveryAdresseType::class, [
            'required' => false,
            ])
        ->add('billingAdresse', BillingAdresseType::class, [
            'required' => false,
        ]);
        // Ajoutez d'autres champs nécessaires pour l'entité Orders
        // ->add('submit', SubmitType::class, [
        //     'label' => 'Create Order',
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
