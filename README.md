krcms-bundle
============

Content Management System for integration in (existing) Symfony 3 projects.

Easy to connect with your own security and user management (bundle).


## Installation

### Step 1: Composer

Add KRSolutionsKRCMSBundle to your composer.json

```json
{
    "require": {
        "kr-solutions/krcms-bundle": "~1",
    }
}
```

also add **component-dir** under config node of composer.json

```json
{
    "config": {
        "component-dir": "web/assets"
    }
}
```

Now tell composer to download the bundle by running the command:


```sh
composer update kr-solutions/krcms-bundle
```

### Step 2: Enable the bundle

Enable the bundle in the kernel:

```php
<?php
// app/AppKernel.php

public function registerBundles()
{
    $bundles = array(
        // ...
        new KRSolutions\Bundle\KRCMSBundle\KRSolutionsKRCMSBundle(),
        new Ivory\CKEditorBundle\IvoryCKEditorBundle(),
        new FM\ElfinderBundle\FMElfinderBundle(),
        // ...
    );
}
```

### Step 3: Import KRSolutionsKRCMSBundle routing files

Problably before all your other routing, but after your security routing, insert:

(you can change the prefix, but remember to use the same prefix in the next step (security.yml)).

``` yaml
# app/config/routing.yml
kr_solutions_krcms_admin:
    resource: "@KRSolutionsKRCMSBundle/Resources/config/routing_admin.yml"
    prefix:   /cms

kr_solutions_krcms:
    resource: "@KRSolutionsKRCMSBundle/Resources/config/routing.yml"
    prefix:   /
```

### Step 4: Configure your application's security.yml

Secure the CMS with access_control, you can use your own roles here:


``` yaml
# app/config/security.yml
security:

    //....
    access_control:
        //....
        - { path: ^/cms/, role: ROLE_USER }

```

### Step 5: Minimal configuration

This bundle needs to know which user class to use for cms users. This can be your own, using your own login screens etc.

This user class has to have an identifier field called 'id' for it's relationships. If you are using another primary field name: bad luck. Try to change it or fork this bundle.

```yaml
# app/config/config.yml

# Enable the translator
parameters:
    locale: en

framework:
    #....
    translator:      { fallbacks: ["%locale%"] }
    #....

# KRSolutionsKRCMSBundle configuration
kr_solutions_krcms:
    db_driver: orm # Currently only the orm driver is supported
    model:
        user_class: AppBundle\Entity\User
```

### Step 6: Install assets & update the database schema

```sh
php bin/console assets:install --relative
php bin/console doctrine:schema:update --force
```


### Optional: Implement custom username implementation for display in this CMS

The system is trying to find out the username for display in the CMS by trying to get the following methods from the user class:

 - getKRCMSUsername()
 - getUsername()
 - getId()

