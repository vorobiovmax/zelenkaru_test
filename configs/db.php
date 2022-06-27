<?php
$dsn = sprintf(
    '%s:host=%s;port=%s;dbname=%s',
    $_ENV['DB_DRIVER'],
    $_ENV['DB_HOST'],
    $_ENV['DB_PORT'],
    $_ENV['DB_DATABASE']
);

return [
    'class' => 'yii\db\Connection',
    'dsn' => $dsn,
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASSWORD'],
    'charset' => 'utf8',
];
