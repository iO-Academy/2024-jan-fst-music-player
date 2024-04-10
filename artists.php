<?php

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
use CodersCanine\AppFactory\AppFactory;

$factory = new AppFactory();
$factory->createSetUp();

try {
    $allArtistsArray = $factory->getArtistService()->createAllArtistProfile($factory->getAlbumService(), $factory->getSongService());
    echo $factory->getJsonService()->convertArrayToJson($allArtistsArray);
} catch (Throwable $e) {
    http_response_code(400);
    $errorMessage = ["message" => "Unknown artist name"];
    echo $e->getMessage();
}


