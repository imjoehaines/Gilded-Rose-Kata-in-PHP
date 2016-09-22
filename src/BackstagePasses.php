<?php

namespace App;

class BackstagePasses implements Item
{
    public $name = 'Backstage passes to a TAFKAL80ETC concert';
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
}
