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
        $query = SongHydrator::$db->prepare('SELECT `id`, `song_name` AS `name`, `length`, `play_count` AS `playCount`, 
       `is_fav` AS `isFav` FROM `songs` ORDER BY `timestamp` DESC LIMIT 3');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        return $query->fetchAll();
    }
}