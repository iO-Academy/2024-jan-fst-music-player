<?php

namespace CodersCanine\AlbumHydrator;

use AlbumHydrator\Album;
use AlbumHydrator\PDO;
use AlbumHydrator\SongHydrator;

class AlbumHydrator
{
    private static PDO $db;
    public static function getAlbumsByArtist ($artistId): array
    {
        $query = AlbumHydrator::$db->prepare('SELECT `id`, `album_name`, `artwork_id`, `artist_id` FROM `music` WHERE `id` = ?');
        $query->execute([$artistId]);
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        return $query->fetchAll();
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}