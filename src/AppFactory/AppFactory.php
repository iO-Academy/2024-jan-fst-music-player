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
use PDO;

header("Access-Control-Allow-Origin: *");

class AppFactory
{
    private ArtistService $artistService;
    private AlbumService $albumService;
    private SongService $songService;
    private JsonService $jsonService;
    private PDO $db;

    public function createSetUp(): void
    {
        try {
            $this->db = new DatabaseConnector();
            $this->db = $this->db->connect();

            SongHydrator::setDb($this->db);
            AlbumHydrator::setDb($this->db);
            ArtistHydrator::setDb($this->db);

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

    public function getDb()
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
}