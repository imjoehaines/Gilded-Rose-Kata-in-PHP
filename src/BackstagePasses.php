<?php

namespace App;

class BackstagePasses implements Item
{
    private $name = 'Backstage passes to a TAFKAL80ETC concert';
    private $quality;
    private $sellIn;

    public function __construct(int $quality, int $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function tick()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;

            if ($this->sellIn < 11 && $this->quality < 50) {
                $this->quality = $this->quality + 1;
            }

            if ($this->sellIn < 6 && $this->quality < 50) {
                $this->quality = $this->quality + 1;
            }
        }

        $this->sellIn = $this->sellIn - 1;

        if ($this->sellIn < 0) {
            $this->quality = $this->quality - $this->quality;
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
