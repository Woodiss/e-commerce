<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\OrdersType;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('email'),
            TextField::new('firstname'),
            TextField::new('lastname'),
            TelephoneField::new('phone_number'),
            ChoiceField::new('roles', 'Rôles')
            ->allowMultipleChoices()
            ->renderExpanded(false)
            // false = en selectionner plusieurs
            ->renderAsNativeWidget(false)
            // liste des roles
            ->setChoices([
                'Utilisateur' => 'ROLE_USER',
                'Admin' => 'ROLE_ADMIN',
            ]),
        ];
    }
}
