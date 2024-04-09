<?php

namespace CodersCanine\AlbumService;

use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\SongService\SongService;

class AlbumService
{
    public function createAlbumProfile (int $artistId, SongService $songService): array
    {
        $albumsByArtist = AlbumHydrator::getAlbumsByArtist($artistId);
        $albumProfileForArtist = [];
        foreach ($albumsByArtist as $album)
        {
            $songs = $songService->getTrackList($album->getId());
            $albumProfile = [
                'name' => $album->getName(),
                'songs' => $songs,
                'artwork_url' => $album->getArtwork()];
            $albumProfileForArtist[] = $albumProfile;
        }
        return $albumProfileForArtist;
    }
}