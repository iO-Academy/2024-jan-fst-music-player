<?php

require_once 'vendor/autoload.php';

header("Access-Control-Allow-Origin: *");
use CodersCanine\AppFactory\AppFactory;

$factory = new AppFactory();
$factory->createSetUp();


try {
    if (isset($_GET['name'])){
        $artistName = $_GET['name'];
        $allArtistsArray = $factory->getArtistService()->createSpecificArtistProfile($factory->getAlbumService(), $factory->getSongService(), $artistName);
        echo $factory->getJsonService()->convertArrayToJson($allArtistsArray);
    } else {
        http_response_code(400);
        throw new Exception('No name');
    }
} catch (Throwable $e) {
    http_response_code(400);
    $errorMessage = ["message" => "Unknown artist name"];
    echo json_encode($errorMessage);
}
