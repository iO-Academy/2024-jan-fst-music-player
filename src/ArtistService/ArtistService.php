<?php

namespace CodersCanine\ArtistService;

use src\AlbumHydrator\AlbumHydrator;

class ArtistService
{
 public function createArtistProfile($ArtistHydrator, $AlbumHydrator)
 {
     $artistArray = [];
     $artists = ArtistHydrator::getArtists();
     foreach ($artists as $artist)
     {
       $artistToAdd = AlbumService::createAlbumProfile($artist->getId());
        $artistArray += [$artistToAdd];
     }
     return $artistArray;
 }
}