<?php

namespace CodersCanine\ArtistService;

use CodersCanine\AlbumService\AlbumService;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\SongService\SongService;

class ArtistService
{
    public function createArtistProfile(AlbumService $albumService, SongService $songService, string $artistName): array
    {
        $artistArray = [];
        $artistProfileArray = [];
        if (isset($_GET['name'])) {
            $artist = ArtistHydrator::getArtist($artistName);
            $artistAlbums = $albumService->createDetailedAlbumProfile($artist->getId(), $songService);
            return ['name' => $artist->getName(), 'albums' => $artistAlbums];
        } else {
            $artists = ArtistHydrator::getArtists($artistName);
            foreach ($artists as $artist) {
                $artistAlbums = $albumService->createAlbumProfile($artist->getId(), $songService);
                $artistProfileArray[] = ['name' => $artist->getName(), 'albums' => $artistAlbums];
                $artistArray = ['artists' => $artistProfileArray];
            }
            return $artistArray;
        }
    }
}