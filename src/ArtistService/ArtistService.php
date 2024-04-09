<?php

namespace CodersCanine\ArtistService;

use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\AlbumService\AlbumService;

class ArtistService
{
 public function createArtistProfile(AlbumService $albumService)
 {
     $artistArray = [];
     $artists = ArtistHydrator::getArtists();
     foreach ($artists as $artist)
     {
       $artistToAdd = $albumService->createAlbumProfile($artist->getId());
        $artistArray += [$artistToAdd];
     }
     return $artistArray;
 }
}