<?php

require_once 'vendor/autoload.php';

use CodersCanine\AppFactory\AppFactory;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$factory = new AppFactory();
$factory->createSetUp();
$albumService = $factory->getAlbumService();
$jsonService = $factory->getJsonService();
$songService = $factory->getSongService();

$topFiveAlbumArray = $albumService->createTopFiveAlbumsProfile($songService);
echo $jsonService->convertArrayToJson($topFiveAlbumArray);
