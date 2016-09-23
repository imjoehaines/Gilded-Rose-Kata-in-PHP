<?php

namespace App;

class SulfurasHandOfRagnaros implements Item
{
    private $name = 'Sulfuras, Hand of Ragnaros';
    private $quality = 80;
    private $sellIn;

    public function __construct(int $quality, int $sellIn)
    {
        $this->sellIn = $sellIn;
    }

    public function tick()
    {
        // this page intentially left blank
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
