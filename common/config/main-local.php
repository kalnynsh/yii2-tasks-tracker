<?php

$db_config = parse_ini_file(__DIR__ . '/db_config.ini');

return [
    'components' => [
        'db' => [
            'class' => $db_config['class'],
            'dsn' => $db_config['dsn'],
            'username' => $db_config['username'],
            'password' => $db_config['password'],
            'charset' => $db_config['charset'],
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
