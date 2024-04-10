<?php

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
use CodersCanine\AppFactory\AppFactory;

$factory = new AppFactory();
$factory->createSetUp();
$artistService = $factory->getArtistService();
$jsonService = $factory->getJsonService();

try {
    $allArtistsArray = $artistService->createAllArtistProfile($factory->getAlbumService(), $factory->getSongService());
    echo $jsonService->convertArrayToJson($allArtistsArray);
} catch (Throwable $e) {
    http_response_code(400);
    $errorMessage = ["message" => "Unknown artist name"];
    echo $e->getMessage();
}


