<?php

namespace ProxiCMS\ContentBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use ProxiCMS\ContentBundle\Entity\Content;
use ProxiCMS\ContentBundle\Entity\ContentInterface;
use Symfony\Component\Form\FormInterface;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Contenus')
            ->setEntityLabelInSingular(fn (?ContentInterface $content, ?string $pageName) => $content ? $content->getName() : 'Contenu')
            ->setHelp('new', 'Contenu gérable pour l\'application');
    }

    public function configureActions(Actions $actions): Actions
    {
        return parent::configureActions($actions)
            ->setPermission(Action::NEW, 'ROLE_SUPER_ADMIN')
            ->setPermission(Action::DELETE, 'ROLE_SUPER_ADMIN');
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id', 'ID')->onlyOnIndex();
        yield BooleanField::new('public', 'Rendre publique ?')->setColumns(4)
            ->renderAsSwitch(false)
            ->setPermission('ROLE_SUPER_ADMIN')
            ->setHelp('Une valeur publique sera visible par tout le monde');
        yield BooleanField::new('textEditor', 'Activer éditeur texte amélioré ?')->setColumns(4)
            ->onlyOnForms()
            ->renderAsSwitch(false)
            ->setPermission('ROLE_SUPER_ADMIN')
            ->setHelp('Une fois activé et validé, vous aurez un éditeur de text amélioré');
        yield ChoiceField::new('category', 'Catégorie')->setColumns(4)
                ->setTranslatableChoices(Content::getCategories())
                ->setPermission('ROLE_SUPER_ADMIN');
        yield TextField::new('identifier', 'Identifiant')->setColumns(6)
            ->setPermission('ROLE_SUPER_ADMIN')
            ->setHelp('Cet identifiant permet d\'être utilisé pour appeler la variable dans cette application. Déconseillé de modifier');
        yield TextField::new('name', 'Nom')->setColumns(6)
            ->onlyOnForms()
            ->setPermission('ROLE_SUPER_ADMIN')
            ->setHelp('Nom pour reconnaître rapidement à quoi sert la variable');
        yield TextField::new('name', 'Nom')->setColumns(6)
            ->hideOnForm()
            ->setPermission('ROLE_ADMIN')
            ->setHelp('Nom pour reconnaître rapidement à quoi sert la variable');
        yield TextEditorField::new('value', 'Valeur');
    }

    public function configureFilters(Filters $filters): Filters
    {
        return parent::configureFilters($filters)
            ->add(ChoiceFilter::new('category', 'Catégorie')->setChoices(array_flip(Content::getCategories())))
            ->add('public');
    }

    public function createNewForm(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormInterface
    {
        $valueField = $entityDto->getFields()->getByProperty('value');
        $entityDto->getFields()->unset($valueField);

        return parent::createNewForm($entityDto, $formOptions, $context);
    }

    public function createEditForm(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormInterface
    {
        // Si on a le mode Wysiwyg (textEditor), on active éditeur texte avancé
        if (false === $entityDto->getInstance()->isTextEditor()) {
            $valueField = $entityDto->getFields()->getByProperty('value');
            $valueFieldTextEditor = TextField::new('value', 'Valeur');

            $entityDto->getFields()->unset($valueField);
            $entityDto->getFields()->set($valueFieldTextEditor->getAsDto());
        }

        return parent::createEditForm($entityDto, $formOptions, $context);
    }
}
