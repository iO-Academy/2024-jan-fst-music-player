<?php

namespace CodersCanine\AppFactory;

use CodersCanine\JsonService\JsonService;
use CodersCanine\ArtistService\ArtistService;
use CodersCanine\AlbumService\AlbumService;
use CodersCanine\SongPlayedService\SongPlayedService;
use CodersCanine\SongService\SongService;
use CodersCanine\DatabaseConnector\DatabaseConnector;
use CodersCanine\SongHydrator\SongHydrator;
use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use Throwable;
use PDO;

header("Access-Control-Allow-Origin: *");

class AppFactory
{
    private ArtistService $artistService;
    private AlbumService $albumService;
    private SongService $songService;
    private JsonService $jsonService;
    private PDO $db;
    private FavouriteService $favouriteService;
    private SongPlayedService $songPlayedService;

    public function createSetUp(): void
    {
        try {
            $databaseConnector = new DatabaseConnector();
            $this->db = $databaseConnector->connect();

            SongHydrator::setDb($this->db);
            AlbumHydrator::setDb($this->db);
            ArtistHydrator::setDb($this->db);

            $this->artistService = new ArtistService();
            $this->albumService = new AlbumService();
            $this->songService = new SongService();
            $this->jsonService = new JsonService();
            $this->favouriteService = new FavouriteService();
            $this->songPlayedService = new SongPlayedService();

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

    public function getDb(): PDO
    {
        return $this->db;
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

    public function getFavouriteService(): FavouriteService
    {
        return $this->favouriteService;
    }

    public function getSongPlayedService(): SongPlayedService
    {
        return $this->songPlayedService;
    }
}