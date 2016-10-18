<?php
return [
    'defaultLang' => 'ru',
    'allowLanguages' => ['ru', 'en', 'uk'],
    'components' => [
        'urlManager' => [
            'controller' => 'site',
            'action' => 'index',
        ]
    ],
];