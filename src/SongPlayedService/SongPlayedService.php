<?php

namespace CodersCanine\SongPlayedService;

use CodersCanine\DatabaseConnector\DatabaseConnector;
use Throwable;
use PDO;

class SongPlayedService
{
    public function updatePlayCount(string $songName, string $artistName, PDO $db, array $postData) : void
    {
        try {
            $query = $db->prepare("UPDATE songs
            INNER JOIN albums ON albums.id = album_id
            INNER JOIN artists ON artists.id = artist_id
            SET play_count = play_count + 1
            WHERE song_name = ? AND artist_name = ?");
            $query->execute([$songName, $artistName]);

            http_response_code(201);
            $successMessage = ['message'=>'Successfully recorded play.'];
            echo json_encode($successMessage);
        } catch (Throwable $e) {
            http_response_code(400);
            $errorMessage = ['message'=>'Invalid song data', 'data'=>$postData];
            echo json_encode($errorMessage);
        }
    }
}