<?php
namespace App\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'label' => 'Votre nom',
                'attr' =>  ['placeholder' => 'Entrez votre nom']
            ])
            ->add('email',EmailType::class, [
                'label' => 'Votre email',
                'attr' =>  ['placeholder' => 'Entrez votre email']
            ])
            ->add('message', TextareaType::class, [
                'attr' => [
                    'rows' => 6,
                    'placeholder' => "Expliquer nous votre problème"
                ],
            ])
            ->add('problem', ChoiceType::class, [
                'choices'  => [
                    'Facturation' => 'Facturation',
                    'Mode de paiement' => 'Paiement',
                    'Livraison' => 'Livraison',
                    'Commande' => 'Commande',
                    'Autre' => 'Autre',
                    'Retour' => 'Retour',
                    'Mon compte' => 'compte'
                ],
                'label' => 'Nature du problème'
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}