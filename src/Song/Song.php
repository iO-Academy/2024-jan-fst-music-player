<?php

namespace CodersCanine\Song;

class Song
{
    private int $id;
    private string $name;
    private float $length;
    private int $playCount;
    private bool $isFav;
    private int $albumId;
    private $timestamp;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getTimestamp()
    {
        return $this->timestamp;
    }

    public function getPlayCount(): int
    {
        return $this->playCount;
    }

    public function getFav(): bool
    {
        return $this->isFav;
    }

    public function getLength(): string
    {
        return number_format($this->length, '2', '.', '');
    }

    public function getAlbumId(): int
    {
        return $this->albumId;
    }
}
