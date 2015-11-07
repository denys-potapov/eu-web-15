<?php

require_once __DIR__.'/../vendor/autoload.php';

Dotenv::load(__DIR__.'/../');

$app = new Laravel\Lumen\Application(realpath(__DIR__.'/../'));
$app->withEloquent();

return $app;
