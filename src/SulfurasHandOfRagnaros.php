<?php

namespace App;

class SulfurasHandOfRagnaros implements Item
{
    public $name = 'Sulfuras, Hand of Ragnaros';
    public $quality = 80;
    public $sellIn;

    public function __construct(int $quality, int $sellIn)
    {
        $this->sellIn = $sellIn;
    }

    public function tick()
    {
        // this page intentially left blank
    }
}
