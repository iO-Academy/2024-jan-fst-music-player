<?php

namespace CodersCanine\AlbumHydrator;

use CodersCanine\Album\Album;
use PDO;

class AlbumHydrator
{
    private static PDO $db;
    public static function getAlbumsByArtist (int $artistId): array
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

    public static function getTopFiveAlbums (): array
    {
        $query = AlbumHydrator::$db->prepare('SELECT albums.id, album_name, SUM(songs.play_count) AS total_play_count FROM albums JOIN songs ON albums.id = album_id GROUP BY albums.id ORDER BY total_play_count DESC LIMIT 5;');
        $query->execute();
        $query->setFetchMode(PDO::FETCH_CLASS, Album::class);
        return $query->fetchAll();
    }
}