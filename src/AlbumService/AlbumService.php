<?php

namespace CodersCanine\AlbumService;

use src\AlbumHydrator;
use src\SongService;

class AlbumService
{
    public function createAlbumProfile (int $artistId, SongService $songService) : array
    {
        $albumsByArtist = AlbumHydrator::getAlbumsByArtist($artistId);
        foreach ($albumsByArtist as $album)
        {
            $songs = $songService->getSongs();
            $albumProfile = [
                'name' => $album->getName(),
                'songs' => $songs,
                'artwork_url' => $album->getArtwork()];
        }
        return $albumProfile;
    }
}