<?php

namespace CodersCanine\AlbumService;

use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\SongService\SongService;

class AlbumService
{
    public function createAlbumProfile (int $artistId, SongService $songService): array
    {
        $discography = AlbumHydrator::getAlbumsByArtist($artistId);
        $albumProfileForArtist = [];
        foreach ($discography as $album) {
            $songs = $songService->getTrackList($album->getId());
            $albumProfile = [
                'name' => $album->getName(),
                'songs' => $songs,
                'artwork_url' => $album->getArtwork()];
            $albumProfileForArtist[] = $albumProfile;
        }
        return $albumProfileForArtist;
    }

    public function createDetailedAlbumProfile (int $artistId, SongService $songService): array
    {
        $discography = AlbumHydrator::getAlbumsByArtist($artistId);
        $albumProfileForArtist = [];
        foreach ($discography as $album) {
            $songs = $songService->createSongProfile($album->getId());
            $albumProfile = [
                'name' => $album->getName(),
                'songs' => $songs,
                'artwork_url' => $album->getArtwork()
            ];
            $albumProfileForArtist[] = $albumProfile;
        }
        return $albumProfileForArtist;
    }

    public function createTopFiveAlbumsProfile (SongService $songService): array
    {
        $topFiveAlbums = AlbumHydrator::getTopFiveAlbums();
        $topFiveAlbumsProfile= [];
        foreach ($topFiveAlbums as $album) {
            $songs = $songService->getTrackList($album->getId());
            $artist = ArtistHydrator::getArtistById($album->getArtistId());

            $albumProfile = [
                'artist'=> $artist->getName(),
                'name' => $album->getName(),
                'songs' => $songs,
                'artwork_url' => $album->getArtwork()];
            $topFiveAlbumsProfile[] = $albumProfile;
        }
        return $topFiveAlbumsProfile;
    }
}