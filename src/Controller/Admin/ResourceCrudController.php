<?php

namespace App\Controller\Admin;

use App\Entity\Resource;
use App\Form\Type\DocumentFileType;
use App\Form\Type\DocumentImageType;
use App\Form\Type\ResourceImageType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ResourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Resource::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            'title',
            'period',
            'theme',
            'environment',
            CollectionField::new('images')
                ->setEntryType(ResourceImageType::class)
                ->renderExpanded()
                ->setEntryIsComplex()
                ->showEntryLabel(),
            CollectionField::new('documents')
                ->setEntryType(DocumentFileType::class)
                ->renderExpanded()
                ->setEntryIsComplex()
                ->showEntryLabel(),
        ];
    }
}
