<?php

namespace CodersCanine\AlbumHydrator;

use CodersCanine\Album\Album;
use PDO;

class AlbumHydrator
{
    private static PDO $db;
    public static function getAlbumsByArtist ($artistId): array
    {
        $query = AlbumHydrator::$db->prepare('SELECT `id`, `album_name` AS `name`, `artwork_url` AS `artwork`, `artist_id` AS `artistId` FROM `albums` WHERE `artist_id` = ?');
        $query->execute([$artistId]);
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        return $query->fetchAll();
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}