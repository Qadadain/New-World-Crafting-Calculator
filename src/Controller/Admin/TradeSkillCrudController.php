<?php

namespace App\Controller\Admin;

use App\Entity\TradeSkill;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TradeSkillCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TradeSkill::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            AssociationField::new('type'),
            SlugField::new('slug')->setTargetFieldName('name')
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Métier')
            ->setSearchFields(['id', 'name', 'type', 'slug']);
    }
}
