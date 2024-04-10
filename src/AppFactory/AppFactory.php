<?php

namespace CodersCanine\AppFactory;

use CodersCanine\JsonService\JsonService;
use CodersCanine\ArtistService\ArtistService;
use CodersCanine\AlbumService\AlbumService;
use CodersCanine\SongService\SongService;
use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\SongHydrator\SongHydrator;
use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use Throwable;

header("Access-Control-Allow-Origin: *");

class AppFactory
{
    private ArtistService $artistService;
    private AlbumService $albumService;
    private SongService $songService;
    private JsonService $jsonService;

    public function createSetUp(): void
    {
        try {
            $db = new DatabaseConnector();
            $db = $db->connect();

            SongHydrator::setDb($db);
            AlbumHydrator::setDb($db);
            ArtistHydrator::setDb($db);

            $this->artistService = new ArtistService();
            $this->albumService = new AlbumService();
            $this->songService = new SongService();
            $this->jsonService = new JsonService();


        } catch (Throwable) {
            http_response_code(500);
            $errorMessage = ["message" => "Unexpected error"];
            echo json_encode($errorMessage);
        }
    }

    public function getArtistService(): ArtistService
    {
        return $this->artistService;
    }

    public function getAlbumService(): AlbumService
    {
        return $this->albumService;
    }

    public function getSongService(): SongService
    {
        return $this->songService;
    }

    public function getJsonService(): JsonService
    {
        return $this->jsonService;
    }
}