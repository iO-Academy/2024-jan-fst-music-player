<?php

use src\artistClass\Artist;

class SongHydrator
{
    private static PDO $db;
    public static function getArtists (): array
    {
        $query = \src\SongHydrator\SongHydrator::$db->prepare('SELECT `id`, `song_name`, `length`, `album_id` FROM `music`');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        return $query->fetchAll;
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}