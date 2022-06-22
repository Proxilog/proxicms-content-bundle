# ProxiCMS - ContentBundle

[![Latest Stable Version](https://poser.pugx.org/proxilog/proxicms-content-bundle/v)](https://packagist.org/packages/proxilog/proxicms-content-bundle)

***/!\  WARNING, Be aware until the version 1.0.0, some breaking changes can be introduce***

This bundle allow you to manage the content for the ProxiCMS.

## TODO

* Create the [Recipes](https://github.com/symfony/recipes-contrib) installation
* better use of migration? (any idea?)
* Create the tests in the bundle (instead of the app side)

## Usage

### EasyAdmin

It will provide a Content to manage with the possibility to enable the text editor.

### Twig

When you get the Content with twig, it will create or get the current one by its identifier.

* Get the [Content](src/Entity/Content.php) object with identifier `proxicms_content_obj('identifier')`
* Get the value with identifier `proxicms_content_val('identifier')`

## Installation

This bundle requires PHP 8.1 or higher and Symfony 6.1 or higher. 

### Step 1: Install the bundle using composer

```bash
$ composer require proxilog/proxicms-content-bundle
```

### Step 2: Add the bundle to your bundles.php

```php
// config/bundles.php
return [
    //..
    ProxiCMS\ContentBundle\ProxiCMSContentBundle::class => ['all' => true],
];
```

### Step 3: Add the MenuItem in your Dashboard EasyAdmin

```php
// src/Controller/Admin/DashboardController.php
public function configureMenuItems(): iterable
    {
        //...
        yield MenuItem::linkToCrud('Contenus', 'fas fa-pager', Content::class)
                    ->setController(ContentCrudController::class);
    }
```

or you can create your own `ContentCrudController` and extends this controller.

### Step 4: Add the migrations in your app


```yaml
# config/doctrine_migrations.yaml
doctrine_migrations:
    migrations:
        - 'ProxiCMS\ContentBundle\Migrations\MySQL0100'
```
