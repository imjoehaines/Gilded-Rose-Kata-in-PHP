<?php

namespace App;

class GildedRose
{
    private static $itemLookup = [
        'normal' => Normal::class,
        'Aged Brie' => AgedBrie::class,
        'Sulfuras, Hand of Ragnaros' => SulfurasHandOfRagnaros::class,
        'Backstage passes to a TAFKAL80ETC concert' => BackstagePasses::class,
        'Conjured Mana Cake',
    ];

    public static function of(string $name, int $quality, int $sellIn) : Item
    {
        return new static::$itemLookup[$name]($quality, $sellIn);
    }
}
