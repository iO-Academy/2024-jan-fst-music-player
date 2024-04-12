<?php

require_once 'vendor/autoload.php';

use CodersCanine\AppFactory\AppFactory;

header("Access-Control-Allow-Origin: *");

$json = file_get_contents('php://input');
$data = json_decode($json, true);

$factory = new AppFactory();
$factory->createSetUp();
$favouriteService = $factory->getFavouriteService();

$favouriteService->updateIsFav($data['name'], $data['artist'], $factory->getDb(), $data);
