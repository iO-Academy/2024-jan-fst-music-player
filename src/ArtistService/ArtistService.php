<?php

namespace CodersCanine\ArtistService;

use CodersCanine\ArtistHydrator\ArtistHydrator;

class ArtistService
{
 public function createArtistProfile($AlbumService, $SongService) : array
 {
     $artistArray = [];
     $artistProfileArray = [];
     $artists = ArtistHydrator::getArtists();
     foreach ($artists as $artist)
     {
       $albumToAdd = $AlbumService->createAlbumProfile($artist->getId(), $SongService);
       $artistProfileArray += ['name' => $artist->getName(), 'albums' =>$albumToAdd];
       $artistArray = ['artists' => $artistProfileArray];
     }
     return $artistArray;
 }
}