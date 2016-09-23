<?php

namespace App;

class Normal implements Item
{
    private $name = 'Normal';
    private $quality;
    private $sellIn;

    public function __construct(int $quality, int $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function tick()
    {
        if ($this->quality > 0) {
            $this->quality = $this->quality - 1;
        }

        $this->sellIn = $this->sellIn - 1;

        if ($this->sellIn < 0 && $this->quality > 0) {
            $this->quality = $this->quality - 1;
        }
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function getQuality() : int
    {
        return $this->quality;
    }

    public function getSellIn() : int
    {
        return $this->sellIn;
    }
}
