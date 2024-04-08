<?php

namespace src\AlbumHydrator;

use AlbumHydrator\Album;
use AlbumHydrator\PDO;
use AlbumHydrator\SongHydrator;

class AlbumHydrator
{
    private static PDO $db;
    public static function getAlbumsByArtist ($artistId): array
    {
        $query = SongHydrator::$db->prepare('SELECT `id`, `song_name`, `length`, `album_id` FROM `music` WHERE `id` = ?');
        $query->execute([$artistId]);
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        return $query->fetchAll;
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}