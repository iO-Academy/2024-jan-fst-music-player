<?php

namespace CodersCanine\ArtistService;

use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\AlbumService\AlbumService;
use CodersCanine\SongService\SongService;

class ArtistService
{
 public function createArtistProfile(AlbumService $albumService, SongService $songService) : array
 {
     $artistArray = [];
     $artists = ArtistHydrator::getArtists();
     foreach ($artists as $artist)
     {
       $artistToAdd = $albumService->createAlbumProfile($artist->getId(), $songService);
        $artistArray += [$artistToAdd];
     }
     return $artistArray;
 }
}