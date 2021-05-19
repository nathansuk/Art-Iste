<?php

namespace App\Controller\Admin\Articles;

use App\Entity\NewsCategory;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class NewsCategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return NewsCategory::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            ColorField::new('color'),
        ];
    }

}
