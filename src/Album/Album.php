<?php

namespace CodersCanine\Album;

class Album
{
    private int $id;
    private string $name;
    private string $artwork;
    private int $artistId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getArtwork(): string
    {
        return $this->artwork;
    }

    public function getArtistId(): int
    {
        return $this->artistId;
    }
}