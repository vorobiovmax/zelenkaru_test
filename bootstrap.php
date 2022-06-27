<?php
require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/vendor/yiisoft/yii2/Yii.php';

//load .env
(Dotenv\Dotenv::createImmutable(__DIR__ . '/docker/mysql'))->load();

$config = require __DIR__ . '/configs/application.php';
