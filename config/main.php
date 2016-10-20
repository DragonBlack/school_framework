<?php
return [
    'defaultLang' => 'ru',
    'allowLanguages' => ['ru', 'en', 'uk'],
    'components' => [
        'urlManager' => [
            'controller' => 'site',
            'action' => 'index',
        ],

        'db' => [
            'class' => 'framework\db\Db',
            'dbhost' => 'localhost',
            'dbname' => 'mvc',
            'dbuser' => 'root',
            'dbpass' => '',
        ],
    ],
];