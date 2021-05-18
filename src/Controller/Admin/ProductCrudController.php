<?php

namespace App\Controller\Admin;

use App\Entity\Product;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            TextField::new('subtitle'),
            TextareaField::new('description'),
            ImageField::new('illustration')
                ->setUploadDir('public/uploads')
                ->setBasePath('uploads/')
                ->setUploadedFileNamePattern('[randomhash], [extention]')
                ->setRequired(false),
            MoneyField::new('price')
                ->setCurrency('EUR'),
            AssociationField::new('category'), 
            SlugField::new('slug')
                -> setTargetFieldName('name')
        ];
    }

}
