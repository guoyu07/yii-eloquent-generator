Eloquent Model Generator
================================

Generate Eloquent models with relationships, validation rules, and labels all generated from a live db.

CONFIGURATION
-------------

### Database

Edit the file `config/web.php` with real data, for example:

```
#!php
$config = [
    //...
    'components' => [
        //...
        'homestead' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;port=3306;dbname=homestead',
            'username' => 'homestead',
            'password' => 'secret',
            'charset' => 'utf8',
        ],
    //...
];

```

Then set a server to point to /web as root.

USE
---
Go to /index.php?r=gii
Click "Start" under Eloquent model generator.  Then follow the instructions from there.


DIRECTORY STRUCTURE
-------------------

      laravel/            contains Eloquent generation code and templates
      config/             contains application configurations


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.

