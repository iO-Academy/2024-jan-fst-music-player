<?php

namespace CodersCanine\ArtistService;

class ArtistService
{
 public function createArtistProfile($albumHydrator, $artistId)
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