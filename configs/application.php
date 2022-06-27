<?php

$db = require __DIR__ . '/db.php';

return [
    'id' => 'zelenkaru-test',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'mvorobiov\controllers',
    'components' => [
        'db' => $db,
    ],
];
