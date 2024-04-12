<?php

namespace CodersCanine\FavouriteService;

use CodersCanine\SongHydrator\SongHydrator;
use Throwable;
use PDO;

class FavouriteService
{
    public function updateIsFav(string $songName, string $artistName, PDO $db, array $postData) : void
    {
        try {
            $query = $db->prepare("UPDATE songs
            INNER JOIN albums ON albums.id = album_id
            INNER JOIN artists ON artists.id = artist_id
            SET is_fav = !is_fav
            WHERE song_name = ? AND artist_name = ?");
            $query->execute([$songName, $artistName]);

            $song = SongHydrator::getSongByName($songName, $artistName);
            if ($song->getFav()){
                http_response_code(202);
                $successMessage = ['message'=>'Successfully favourited song.'];
                echo json_encode($successMessage);
            } else {
                http_response_code(202);
                $successMessage = ['message'=>'Successfully unfavourited song.'];
                echo json_encode($successMessage);
            }
        } catch (Throwable) {
            http_response_code(400);
            $errorMessage = ['message'=>'Invalid song data', 'data'=>$postData];
            echo json_encode($errorMessage);
        }
    }
}