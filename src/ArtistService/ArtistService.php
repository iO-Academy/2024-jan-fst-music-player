<?php

namespace CodersCanine\ArtistService;

use CodersCanine\ArtistHydrator\ArtistHydrator;

class ArtistService
{
 public function createArtistProfile($albumService, $songService): array
 {
     $artistArray = [];
     $artistProfileArray = [];
     $artists = ArtistHydrator::getArtists();
     foreach ($artists as $artist)
     {
       $albumToAdd = $albumService->createAlbumProfile($artist->getId(), $songService);
       $artistProfileArray[] = ['name' => $artist->getName(), 'albums' =>$albumToAdd];
       $artistArray = ['artists' => $artistProfileArray];
     }
     return $artistArray;
 }
}