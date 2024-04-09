<?php

namespace CodersCanine\SongHydrator;
use src\songClass\Song;

class SongHydrator
{
    private static PDO $db;

    public static function getSongsByAlbum($albumId): array
    {
        $query = SongHydrator::$db->prepare('SELECT `id`, `song_name`, `length`, `album_id` FROM `music` WHERE `album_id` = ?');
        $query->execute([$albumId]);
        $query->setFetchMode(PDO::FETCH_CLASS, Song::class);
        return $query->fetchAll;
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}