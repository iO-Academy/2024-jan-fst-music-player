<?php

namespace CodersCanine\Song;
class Song
{
    private int $id;
    private string $name;
    private float $length;
    private int $albumId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLength(): float
    {
        return $this->length;
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }
}