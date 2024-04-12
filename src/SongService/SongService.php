<?php

namespace CodersCanine\SongService;

use CodersCanine\AlbumHydrator\AlbumHydrator;
use CodersCanine\ArtistHydrator\ArtistHydrator;
use CodersCanine\SongHydrator\SongHydrator;

class SongService
{
    public function getTrackList(int $albumId): array
    {
        $trackList = [];
        $songs = SongHydrator::getSongsByAlbum($albumId);
        foreach ($songs as $song) {
            $trackList[] = $song->getName();
        }
        return $trackList;
    }

    public function createSongProfile(int $albumId): array
    {
        $trackList = [];
        $songs = SongHydrator::getSongsByAlbum($albumId);
        foreach ($songs as $song) {
            $trackList[] = [
                "name" => $song->getName(),
                "length" => number_format($song->getLength(),2,'.',''),
                "play_count" => $song->getPlayCount(),
                "is_fav" => $song->getFav()
            ];
        }
        return $trackList;
    }

    public function createRecentSongsProfile(): array
    {
        $recentSongsProfile = [];
        $recentSongs = songHydrator::getRecentSongs();

        foreach ($recentSongs as $song) {
            $album = AlbumHydrator::getAlbumById($song->getAlbumId());
            $artist = ArtistHydrator::getArtistById($album->getArtistId());
            $songProfile = [
                "name"=>$song->getName(),
                "artist"=>$artist->getName(),
                "length"=>number_format($song->getLength(),2,'.',''),
                "artwork_url"=>$album->getArtwork(),
                "is_fav"=>$song->getFav()
            ];
            $recentSongsProfile[] = $songProfile;
        }
        return $recentSongsProfile;
    }

    public function createSearchProfile(string $searchData): array
    {
        $searchProfile = [];
        $searchSongs = songHydrator::getSearchedSongs($searchData);

        foreach ($searchSongs as $song) {
            $album = AlbumHydrator::getAlbumById($song->getAlbumId());
            $artist = ArtistHydrator::getArtistById($album->getArtistId());
            $songProfile = [
                "name" => $song->getName(),
                "artist" => $artist->getName(),
                "length" => number_format($song->getLength(),2,'.',''),
                "artwork_url" => $album->getArtwork(),
                "play_count" => $song->getPlayCount(),
                "is_fav" => $song->getFav()
            ];
            $searchProfile[] = $songProfile;
        }
        return $searchProfile;
    }
}
