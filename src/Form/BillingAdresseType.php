<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\BillingAdresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BillingAdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('full_name', TextType::class, [
                'label' => 'Nom complet'
            ])
            ->add('adresse', TextType::class, [
                'label' => 'Adresse'
            ])
            ->add('City', TextType::class, [
                'label' => 'Ville'
            ])
            ->add('postal_code', TextType::class, [
                'label' => 'Code postal'
            ])
            ->add('phone_number', TextType::class, [
                'label' => 'Téléphone'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BillingAdresse::class,
        ]);
    }
}
