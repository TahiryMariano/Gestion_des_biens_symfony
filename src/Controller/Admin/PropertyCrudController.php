<?php

namespace App\Controller\Admin;


use App\Entity\Property;
use App\Field\VichImageField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\MoneyField;

class PropertyCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Property::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
            ->update(Crud::PAGE_INDEX, Action::NEW, function (Action $action) {
                return $action->setIcon('fa fa-user')->addCssClass('btn btn-success');
            })
            ->update(Crud::PAGE_INDEX, Action::EDIT, function (Action $action) {
                return $action->setIcon('fa fa-edit')->addCssClass('btn btn-warning');
            })
            ->update(Crud::PAGE_INDEX, Action::DETAIL, function (Action $action) {
                return $action->setIcon('fa fa-eye')->addCssClass('btn btn-info');
            })
            ->update(Crud::PAGE_DETAIL, Action::DELETE, function (Action $action) {
                return $action->setCssClass('action-delete btn btn-outline-danger');
            })
            ->update(Crud::PAGE_INDEX, Action::DELETE, function (Action $action) {
                return $action->setCssClass('action-delete btn btn-outline-danger')->setIcon('fa fa-trash');
            });
    }
    public function configureFields(string $pageName): iterable
    {

        return [
            TextField::new('title')->setColumns('col-sm-3 col-lg-3 col-xxl-3'),
            TextField::new('adress')->setColumns('col-sm-3 col-lg-3 col-xxl-3'),
            TextareaField::new('description')->setColumns('col-sm-3 col-lg-3 col-xxl-3'),
            MoneyField::new('price')->setCurrency('USD')->setColumns('col-sm-6 col-lg-5 col-xxl-3'),
            IntegerField::new('surface')->onlyOnForms(),
            TextField::new('city')->setColumns('col-sm-6 col-lg-5 col-xxl-3'),
            TextField::new('code_postal')->setColumns('col-sm-6 col-lg-5 col-xxl-3'),
            IntegerField::new('room')->onlyOnForms()->setColumns(3),
            IntegerField::new('bedroom')->onlyOnForms()->setColumns(3),
            IntegerField::new('floor')->onlyOnForms()->setColumns(3),
            IntegerField::new('heat')->onlyOnForms()->setColumns(3),
            BooleanField::new('sold'),
            AssociationField::new('options', 'option')->hideOnIndex(),
            ImageField::new('filename', 'Image')
                ->hideOnForm()
                ->setBasePath('images/properties'),
            VichImageField::new('imageFile')->onlyOnForms(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setDefaultSort(['created_at' => 'DESC']);
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('title');
    }
}
