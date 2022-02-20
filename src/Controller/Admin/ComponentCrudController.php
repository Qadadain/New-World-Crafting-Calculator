<?php

namespace App\Controller\Admin;

use App\Entity\Component;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ComponentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Component::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            AssociationField::new('recipe', 'Recette'),
            AssociationField::new('tradeSkill', 'Métier'),
            SlugField::new('slug', 'Slug')->setTargetFieldName('name')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Composants')
            ->setSearchFields(['id', 'name', 'recipe', 'slug']);
    }

}
