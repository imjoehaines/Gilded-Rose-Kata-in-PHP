<?php

namespace App;

class AgedBrie implements Item
{
    public $name = 'Aged Brie';
    public $quality;
    public $sellIn;

    public function __construct(int $quality, int $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public function tick()
    {
        if ($this->quality < 50) {
            $this->quality = $this->quality + 1;
        }

        $this->sellIn = $this->sellIn - 1;

        if ($this->sellIn < 0 && $this->quality < 50) {
            $this->quality = $this->quality + 1;
        }
    }
}
