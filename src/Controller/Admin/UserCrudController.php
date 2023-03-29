<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('prenom'),
            DateTimeField::new('datenais'),
            TextField::new('telephone'),
            TextField::new('cp'),
            TextField::new('ville'),
            ArrayField::new('roles')->hideOnIndex(),
            EmailField::new('email'),
            TextField::new('password')
                ->setFormType(PasswordType::class)
                ->hideOnIndex()
                ->setRequired(false),
            DateTimeField::new('created_at'),
            DateTimeField::new('updated_at')->hideOnIndex(),
            // caractéristiques du champs de mot de passe
        ];
    }
}
