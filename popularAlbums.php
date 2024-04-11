<?php

require_once 'vendor/autoload.php';

use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\JsonService\JsonService;
use CodersCanine\SongPlayedService\SongPlayedService;
use CodersCanine\AppFactory\AppFactory;

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

$factory = new AppFactory();
$factory->createSetUp();
$artistService = $factory->getArtistService();
$jsonService = $factory->getJsonService();

try {
    $topFiveAlbumArray = $artistService->getTopFiveAlbums();
    echo $jsonService->convertArrayToJson($topFiveAlbumArray);
} catch (Throwable $e) {
    http_response_code(400);
    $errorMessage = ["message" => "Unknown artist name"];
    echo json_encode($errorMessage);
}
