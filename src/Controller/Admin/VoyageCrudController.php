<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use App\Form\VoyageImageType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
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
            // IdField::new('id'),
            TextField::new('country'),
            TextField::new('city'),
            TextField::new('title'),
            TextField::new('adresse'),
            IntegerField::new('price'),
            TextEditorField::new('description'),
            TextField::new('little_desc'),
            NumberField::new('longitude'),
            NumberField::new('latitude'),
            BooleanField::new('parking'),
            BooleanField::new('free_wifi'),
            BooleanField::new('pool'),
            BooleanField::new('pets_accept'),
            CollectionField::new('images')
                ->setEntryType(VoyageImageType::class)
        ];
    }
    
}
