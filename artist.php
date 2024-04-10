<?php

require_once 'vendor/autoload.php';

use CodersCanine\AppFactory\AppFactory;
header("Access-Control-Allow-Origin: *");

$factory = new AppFactory();
$factory->createSetUp();
$artistService = $factory->getArtistService();
$jsonService = $factory->getJsonService();

try {
    if (isset($_GET['name'])){
        $artistName = $_GET['name'];
        $allArtistsArray = $artistService->createSpecificArtistProfile($factory->getAlbumService(), $factory->getSongService(), $artistName);
        echo $jsonService->convertArrayToJson($allArtistsArray);
    } else {
        http_response_code(400);
        throw new Exception('No name');
    }
} catch (Throwable $e) {
    http_response_code(400);
    $errorMessage = ["message" => "Unknown artist name"];
    echo json_encode($errorMessage);
}
