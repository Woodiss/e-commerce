<?php

namespace App\Controller\Admin;

use App\Entity\Voyage;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
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
            TextEditorField::new('description'),
            ImageField::new('image')
                ->onlyOnIndex()
                ->setBasePath('/images/voyages'),
        ];
    }
    
}
