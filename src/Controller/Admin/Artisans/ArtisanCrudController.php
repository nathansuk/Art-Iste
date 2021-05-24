<?php

namespace App\Controller\Admin\Artisans;

use App\Entity\Artisan;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtisanCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Artisan::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('user', 'Utilisateur'),
            TextField::new('kbis', 'KBIS'),
            BooleanField::new('isVerified', 'Vérifié'),
            BooleanField::new('atHome', 'Exerce à domicile'),
            BooleanField::new('canMove', 'Se déplace'),
            IntegerField::new('activityPerimeter', 'Périmètre de déplacement'),
            AssociationField::new('category', 'Catégorie')
        ];
    }

}
