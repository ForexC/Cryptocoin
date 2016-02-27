<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'test');
defined('YII_TEST_ENTRY_URL') or define('YII_TEST_ENTRY_URL', '/index-test.php');
defined('YII_TEST_ENTRY_FILE') or define('YII_TEST_ENTRY_FILE', dirname(dirname(__DIR__)) . '/web/index-test.php');
require(__DIR__ . '/../../vendor/autoload.php');
require(__DIR__ . '/../../vendor/yiisoft/yii2/Yii.php');
$config = require(__DIR__ . '/../../config/console.php');
Yii::setAlias('@app', dirname(__DIR__));
