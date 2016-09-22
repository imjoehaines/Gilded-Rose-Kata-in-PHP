<?php

namespace App;

class GildedRose
{
    public static function of(string $name, int $quality, int $sellIn) : Item
    {
        $itemLookup = [
            'normal' => Normal::class,
            'Aged Brie' => AgedBrie::class,
            'Sulfuras, Hand of Ragnaros' => SulfurasHandOfRagnaros::class,
            'Backstage passes to a TAFKAL80ETC concert' => BackstagePasses::class,
            'Conjured Mana Cake',
        ];

        return new $itemLookup[$name]($quality, $sellIn);
    }
}
