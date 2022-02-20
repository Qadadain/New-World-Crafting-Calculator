<?php

namespace App\Controller\Admin;

use App\Entity\StepRecipe;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;

class StepRecipeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return StepRecipe::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('recipe', 'Recettes'),
            AssociationField::new('ingredient', 'Composant'),
            IntegerField::new('quantity', 'Quantité'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Étape de recettes')
            ->setSearchFields(['id', 'recipe', 'ingredient', 'quantity']);
    }
}
