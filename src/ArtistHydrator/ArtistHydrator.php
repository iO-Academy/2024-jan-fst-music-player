<?php

namespace CodersCanine\ArtistHydrator;
use CodersCanine\Artist\Artist;
use PDO;

class ArtistHydrator
{
    private static PDO $db;
    public static function getArtists ($artistName): array
    {
        $query = ArtistHydrator::$db->prepare('SELECT `id`, `artist_name` AS `name` FROM `artists`
                                                WHERE `artist_name` LIKE ?');
        $query->execute([$artistName]);
        $query->setFetchMode(PDO::FETCH_CLASS, Artist::class);
        return $query->fetchAll();
    }

    public static function setDb(PDO $db): void
    {
        self::$db = $db;
    }
}