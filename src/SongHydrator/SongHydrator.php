<?php

namespace CodersCanine\SongHydrator;
use CodersCanine\Song\Song;
use PDO;

class SongHydrator
{
    private static PDO $db;

    public static function getSongsByAlbum(int $albumId): array
    {
        $query = SongHydrator::$db->prepare('SELECT `id`, `song_name` AS `name`, `length`, `album_id` AS `albumId`, `play_count`, `is_fav` FROM `songs` WHERE `album_id` = ?');
        $query->execute([$albumId]);
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        return $query->fetchAll();
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}