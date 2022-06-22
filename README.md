# ProxiCMS - ContentBundle

[![Latest Stable Version](https://poser.pugx.org/proxilog/proxicms-content-bundle/v)](https://packagist.org/packages/proxilog/proxicms-content-bundle)

***/!\  Attention, tant que la version 1.0.0 n'est pas sortie, des "breaking changes" sont possible !***

Ce Bundle permet de gérer la gestion de contenu du CMS ProxiCMS.

## TODO

* TODO faire le [Recipes](https://github.com/symfony/recipes-contrib) installation
* gérer l'intégration de la migration (services ?)
* gérer les Tests
* Terminer la documentation

## Usage

### EasyAdmin

It will provide a Content to manage with the possibility to enable the text editor.

### Twig

When you get the Content with twig, it will create or get the current one by its identifier.

* Get the [Content](src/Entity/Content.php) object with identifier `proxicms_content_obj('identifier')`
* Get the value with identifier `proxicms_content_val('identifier')`

## Installation

* `composer require proxilog/proxicms-content-bundle`
* Ajouter la class dans `bundles.php`
    * `ProxiCMS\ContentBundle\ProxiCMSContentBundle::class => ['all' => true],`
* Ajouter Menu EA
    * `yield MenuItem::linkToCrud('Contenus', 'fas fa-pager', Content::class)->setController(ContentCrudController::class)`
    * OU Créer le `ContentCrudController` et étendre celle de notre bundle si besoin de modifier
* Ajouter la migration `- 'ProxiCMS\ContentBundle\Migrations\MySQL0100'`
* Ajouter dans le menu EA `yield MenuItem::linkToCrud('Contenus', 'fas fa-pager', Content::class);`
