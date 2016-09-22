<?php

namespace App;

class GildedRose implements Item
{
    public $name;

    public $quality;

    public $sellIn;

    public function __construct(int $quality, int $sellIn)
    {
        $this->quality = $quality;
        $this->sellIn = $sellIn;
    }

    public static function of(string $name, int $quality, int $sellIn) : Item
    {
        $itemLookup = [
            'normal' => Normal::class,
            'Aged Brie' => AgedBrie::class,
            'Sulfuras, Hand of Ragnaros',
            'Backstage passes to a TAFKAL80ETC concert',
            'Conjured Mana Cake',
        ];

        if (isset($itemLookup[$name])) {
            return new $itemLookup[$name]($quality, $sellIn);
        }

        if ($name == 'Sulfuras, Hand of Ragnaros') {
            $quality = 80;
        }

        $item = new static($quality, $sellIn);
        $item->name = $name;

        return $item;
    }

    public function tick()
    {
        if ($this->name != 'Aged Brie' and $this->name != 'Backstage passes to a TAFKAL80ETC concert') {
            if ($this->quality > 0) {
                if ($this->name != 'Sulfuras, Hand of Ragnaros') {
                    $this->quality = $this->quality - 1;
                }
            }
        } else {
            if ($this->quality < 50) {
                $this->quality = $this->quality + 1;

                if ($this->name == 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->sellIn < 11) {
                        if ($this->quality < 50) {
                            $this->quality = $this->quality + 1;
                        }
                    }
                    if ($this->sellIn < 6) {
                        if ($this->quality < 50) {
                            $this->quality = $this->quality + 1;
                        }
                    }
                }
            }
        }

        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
            $this->sellIn = $this->sellIn - 1;
        }

        if ($this->sellIn < 0) {
            if ($this->name != 'Aged Brie') {
                if ($this->name != 'Backstage passes to a TAFKAL80ETC concert') {
                    if ($this->quality > 0) {
                        if ($this->name != 'Sulfuras, Hand of Ragnaros') {
                            $this->quality = $this->quality - 1;
                        }
                    }
                } else {
                    $this->quality = $this->quality - $this->quality;
                }
            } else {
                if ($this->quality < 50) {
                    $this->quality = $this->quality + 1;
                }
            }
        }
    }
}
