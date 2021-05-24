<?php

namespace App\Controller\Admin\Artisans;

use App\Entity\ArtisansJob;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtisansJobCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ArtisansJob::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
        ];
    }

}
