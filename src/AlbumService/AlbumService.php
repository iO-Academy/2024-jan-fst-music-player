<?php

namespace CodersCanine\AlbumService;

use src\AlbumHydrator;

class AlbumService
{
    public function createAlbumProfile (int $artistId) : array
    {
        $albumsByArtist = AlbumHydrator::getAlbumsByArtist($artistId);
        foreach ($albumsByArtist as $album)
        {
            $songs = SongService->getSongs();
            $albumProfile = [
                'name' => $album->getName(),
                'songs' => $songs,
                'artwork_url' => $album->getArtwork()];
        }
        return $albumProfile;
    }
}