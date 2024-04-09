<?php

require_once 'vendor/autoload.php';

use CodersCanine\JsonService\JsonService;
use CodersCanine\ArtistService\ArtistService;
use CodersCanine\AlbumService\AlbumService;
use CodersCanine\SongService\SongService;
use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\SongHydrator\SongHydrator;

header("Access-Control-Allow-Origin: *");

try {
    $db = new DatabaseConnector();
    $db = $db->connect();

    SongHydrator::setDb($db);
    AlbumHydrator::setDb($db);
    ArtistHydrator::setDb($db);

    $artistService = new ArtistService();
    $albumService = new AlbumService();
    $songService = new SongService();
    $jsonService = new JsonService();

    isset($_GET['name']) ?  $artistName = $_GET['name'] : $artistName = '%';

    $allArtistsArray = $artistService->createArtistProfile($albumService, $songService, $artistName);

    if (count($allArtistsArray) === 0) {
        http_response_code(400);
        $errorMessage = ["message" => "Unknown artist name"];
    } else {
        echo $jsonService->convertArrayToJson($allArtistsArray);
    }

} catch (Throwable) {
    http_response_code(500);
    $errorMessage = ["message" => "Unexpected error"];
    echo json_encode($errorMessage);
}
