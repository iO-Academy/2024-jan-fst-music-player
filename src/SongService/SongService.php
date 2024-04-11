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
                "length" => $song->getLength(),
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
            $album = AlbumHydrator::getSpecificAlbum($song->getAlbumId());
            $artist = ArtistHydrator::getArtistById($album->getArtistId());
            $songProfile = [
                "name"=>$song->getName(),
                "artist"=>$artist->getName(),
                "length"=>$song->getLength(),
                "artwork_url"=>$album->getArtwork(),
                "play_count"=>$song->getPlayCount(),
                "is_fav"=>$song->getFav()
            ];
            $recentSongsProfile[] = $songProfile;
        }
        return $recentSongsProfile;
    }
}
