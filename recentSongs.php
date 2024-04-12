<?php

require_once 'vendor/autoload.php';

use CodersCanine\AppFactory\AppFactory;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$factory = new AppFactory();
$factory->createSetUp();
$jsonService = $factory->getJsonService();
$songService = $factory->getSongService();

$recentSongsArray = $songService->createRecentSongsProfile();
echo $jsonService->convertArrayToJson($recentSongsArray);
