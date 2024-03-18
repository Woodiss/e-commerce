<?php

namespace App\Controller\Admin;

use App\Entity\VoyageImage;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VoyageImageCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VoyageImage::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('voyage'),
            ImageField::new('name')
                // chemin vers les images (à partir de public/)
                ->setBasePath('images/voyages')
                ->setUploadDir('public/images/voyages/')
                // nom pour la colonne
                ->setLabel('Images'),
            NumberField::new('size')
                ->setLabel('Size (KO)'),
        ];
    }
}
