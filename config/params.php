<?php

return [
    'adminEmail' => 'admin@example.com',
    'expireDepositPeriod' => 60 * 60 * 24 * 1, // Expire deposits period, add in seconds! 1 day: 60 * 60 * 24 * 1
    'payPassword' => "", // Password to get from cron pay methods

    'BTC_IPN_PASSWORD'=>'', // Your IPN password to use a params in notification urls
    'BTC_GUID'=>'', // GUID of blockchain, for example: 9b0e0bf9-28fd-43b7-b743-895f49c594f3
    'BTC_PASSWORD'=>'', // Password of blockchain account
    'BTC_SECOND_PASSWORD'=>'', // second password, don't use this param in this application

];
