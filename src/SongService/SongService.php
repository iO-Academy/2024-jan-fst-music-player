<?php

namespace CodersCanine\SongService;

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
}
