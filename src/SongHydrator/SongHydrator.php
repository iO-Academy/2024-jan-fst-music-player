<?php

namespace CodersCanine\SongHydrator;
use CodersCanine\Song\Song;
use PDO;

class SongHydrator
{
    private static PDO $db;

    public static function getSongsByAlbum(int $albumId): array
    {
        $query = SongHydrator::$db->prepare('SELECT `id`, `song_name` AS `name`, `length`, `album_id` AS `albumId`, `is_fav` AS `isFav`, `play_count` AS `playCount` FROM `songs` WHERE `album_id` = ?');
        $query->execute([$albumId]);
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        return $query->fetchAll();
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
    public static function getRecentSongs(): array
    {
        $query = SongHydrator::$db->prepare('SELECT `id`, `timestamp`, `song_name` AS `name`, `length`, `play_count` AS `playCount`, `album_id` AS `albumId`,  `is_fav` AS `isFav` 
                                                FROM `songs` ORDER BY `timestamp` DESC LIMIT 5');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        return $query->fetchAll();
    }

    public static function getSongByName(string $songName, string $artistName): Song
    {
        $query = SongHydrator::$db->prepare('SELECT songs.`id`, `song_name` AS `name`, `length`, `album_id` AS `albumId`, `is_fav` AS `isFav`, `play_count` AS `playCount` FROM `songs` 
                                                    INNER JOIN albums ON albums.id = album_id
                                                    INNER JOIN artists ON artists.id = artist_id
                                                    WHERE `song_name` = ? AND `artist_name` = ?');
        $query->execute([$songName, $artistName]);
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        return $query->fetch();
    }
}