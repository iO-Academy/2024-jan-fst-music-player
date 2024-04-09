<?php

namespace CodersCanine\Song;
class Song
{
    private int $id;
    private string $name;
    private float $length;
    private int $play_count;
    private bool $is_fav;
    private int $albumId;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPlayCount(): int
    {
        return $this->play_count;
    }

    public function getFav(): bool
    {
        return $this->is_fav;
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
