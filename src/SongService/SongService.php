<?php

namespace CodersCanine\SongService;

use CodersCanine\SongHydrator\SongHydrator;

class SongService
{
    public function getTrackList($albumID): array
    {
        $trackList = [];
        $songs = SongHydrator::getSongsByAlbum($albumID);
        foreach ($songs as $song) {
            $trackList[] = $song->getName();
        }
        return $trackList;
    }

    public function createSongProfile($albumID): array
    {
        $trackList = [];
        $songs = SongHydrator::getSongsByAlbum($albumID);
        foreach ($songs as $song) {
            $trackList[] = ["name" => $song->getName(), "length" => $song->getLength(), "play_count" => $song->getPlayCount(), "is_fav" => $song->getFav()];
        }
        return $trackList;
    }
}