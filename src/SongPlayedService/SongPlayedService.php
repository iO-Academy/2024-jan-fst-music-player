<?php

namespace CodersCanine\SongPlayedService;

use Throwable;

class SongPlayedService
{
    public function updatePlayCount($songName, $artistName, $db, $_POST) : void
    {
        try {
            $query = $db->prepare('UPDATE songs
            INNER JOIN albums ON albums.id = album_id
            INNER JOIN artists ON artists.id = artist_id
            SET play_count = play_count + 1
            WHERE song_name = ' . $songName . 'AND artist_name = ' . $artistName);
            $query->execute();

            http_response_code(201);
            $successMessage = ['message'=>'Successfully recorded play.'];
            echo json_encode($successMessage);
        } catch (Throwable) {
            http_response_code(400);
            $errorMessage = ['message'=>'Invalid song data', 'data'=>$_POST];
            echo json_encode($errorMessage);
        }


    }
}