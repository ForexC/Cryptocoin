Cryptocoin deposits application
============================

With this application you can set up your own coin double deposit bitcoin system.
Installation and integration are easy! This script supports blockchain.info API to receive and send bitcoins from users.

DIRECTORY STRUCTURE
-------------------

      assets/             contains assets definition
      components/         contains libraries to implement PaymentInterface
      config/             contains application configurations
      controllers/        contains Web controller classes
      mail/               contains view files for e-mails
      migrations/         contains migrations to set up your database
      models/             contains model classes
      runtime/            contains files generated during runtime
      tests/              contains various tests for the basic application
      vendor/             contains dependent 3rd-party packages
      views/              contains view files for the Web application
      web/                contains the entry script and Web resources



REQUIREMENTS
------------

The minimum requirement by this project template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from git

Take git clone of this repository, then you should configure your database and set your blockchain account data.
Then you should run: `composer install`

CONFIGURATION
-------------

### Database

Edit the file `config/db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2basic',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
Edit file `config/params.php` with real data, for example:

```php
return [
    'adminEmail' => 'admin@example.com',
    'expireDepositPeriod' => 60 * 60 * 24 * 1, // Expire deposits period, add in seconds! 1 day: 60 * 60 * 24 * 1
    'payPassword' => "qwerty", // Password to get from cron pay methods

    'BTC_IPN_PASSWORD'=>'qwerty1234', // Your IPN password to use a params in notification urls
    'BTC_GUID'=>'9b0e0bf9-28fd-43b7-b743-895f49c594f3', // GUID of blockchain, for example: 9b0e0bf9-28fd-43b7-b743-895f49c594f3
    'BTC_PASSWORD'=>'myblockchainpassword', // Password of blockchain account
    'BTC_SECOND_PASSWORD'=>'', // second password, don't use this param in this application

];
```
After composer installation before accept db migrations `php yii migrate` you should take environments (dev,prod) in pages:
 - `index.php`
 - `yii.php`
 
For development mode you can create files `db-local.php` `params-local.php`

**BLOCKCHAIN API:**
- You should enable blockchain API in blockchain.info settings page.
- You should add blockchain callback to script route /site/income?pass=myblockchainpassword in blockchain.info settings.
- To run unit tests go to `tests` directory and run: `codecept run unit`.
