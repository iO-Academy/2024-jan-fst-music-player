<?php

namespace CodersCanine\ArtistService;

use CodersCanine\AlbumService\AlbumService;
use CodersCanine\Artist\Artist;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\SongService\SongService;
use Exception;
use function PHPUnit\Framework\throwException;

class ArtistService
{
 public function createSpecificArtistProfile(AlbumService $albumService, SongService $songService, string $artistName): array
 {
     $artist = ArtistHydrator::getArtist($artistName);
     $artistAlbums = $albumService->createAlbumProfile($artist->getId(), $songService);
     return ['name' => $artist->getName(), 'albums' => $artistAlbums];
 }

 public function createAllArtistProfile(AlbumService $albumService, SongService $songService):array
 {
     $artistArray = [];
     $artistProfileArray = [];
     $artists = ArtistHydrator::getArtists();
     foreach ($artists as $artist) {
         $artistAlbums = $albumService->createAlbumProfile($artist->getId(), $songService);
         $artistProfileArray[] = ['name' => $artist->getName(), 'albums' => $artistAlbums];
         $artistArray = ['artists' => $artistProfileArray];
     }
     return $artistArray;
 }
}