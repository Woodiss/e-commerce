<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use App\Form\VoyageImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoyageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Voyage::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            IntegerField::new('price'),
            TextEditorField::new('description'),
            CollectionField::new('images')
                ->setEntryType(VoyageImageType::class)

            // AssociationField::new('images')
            // ->setTemplatePath('admin/fields/images.html.twig') // Chemin vers votre template personnalisé
            // ->onlyOnIndex(), // Pour afficher seulement dans la liste, pas dans la vue détaillée
        ];
    }
    
}
