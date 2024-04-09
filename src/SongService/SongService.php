<?php

namespace CodersCanine\SongService;

use CodersCanine\SongHydrator\SongHydrator;

class SongService
{
    public function getTrackList(int $albumID): array
    {
        $trackList = [];
        $songs = SongHydrator::getSongsByAlbum($albumID);
        foreach ($songs as $song) {
            $trackList[] = $song->getName();
        }
        return $trackList;
    }
}