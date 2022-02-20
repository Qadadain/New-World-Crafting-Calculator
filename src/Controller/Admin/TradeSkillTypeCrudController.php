<?php

namespace App\Controller\Admin;

use App\Entity\TradeSkillType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TradeSkillTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return TradeSkillType::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom'),
            AssociationField::new('tradeSkills'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud

            ->setPageTitle('index', 'Type de métier')
            ->setSearchFields(['id', 'name', 'tradeSkills']);
    }
}
