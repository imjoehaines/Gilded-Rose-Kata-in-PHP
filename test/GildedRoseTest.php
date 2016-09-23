<?php

namespace AppTest;

use App\Item;
use App\GildedRose;
use PHPUnit\Framework\TestCase;

class GildedRoseTest extends TestCase
{
    public function testItUpdatesNormalItemsBeforeSellDate()
    {
        $item = GildedRose::of('normal', 10, 5); // quality, sell in X days

        $item->tick();

        $this->assertSame(9, $item->getQuality());
        $this->assertSame(4, $item->getSellIn());
    }

    public function testItUpdatesNormalItemsOnTheSellDate()
    {
        $item = GildedRose::of('normal', 10, 0);

        $item->tick();

        $this->assertSame(8, $item->getQuality());
        $this->assertSame(-1, $item->getSellIn());
    }

    public function testItUpdatesNormalItemsAfterTheSellDate()
    {
        $item = GildedRose::of('normal', 10, -5);

        $item->tick();

        $this->assertSame(8, $item->getQuality());
        $this->assertSame(-6, $item->getSellIn());
    }

    public function testItUpdatesNormalItemsWithAQualityOf0()
    {
        $item = GildedRose::of('normal', 0, 5);

        $item->tick();

        $this->assertSame(0, $item->getQuality());
        $this->assertSame(4, $item->getSellIn());
    }

    public function testItUpdatesBrieItemsBeforeTheSellDate()
    {
        $item = GildedRose::of('Aged Brie', 10, 5);

        $item->tick();

        $this->assertSame(11, $item->getQuality());
        $this->assertSame(4, $item->getSellIn());
    }

    public function testItUpdatesBrieItemsBeforeTheSellDateWithMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 50, 5);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(4, $item->getSellIn());
    }

    public function testItUpdatesBrieItemsOnTheSellDate()
    {
        $item = GildedRose::of('Aged Brie', 10, 0);

        $item->tick();

        $this->assertSame(12, $item->getQuality());
        $this->assertSame(-1, $item->getSellIn());
    }

    public function testItUpdatesBrieItemsOnTheSellDateNearMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 49, 0);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(-1, $item->getSellIn());
    }

    public function testItUpdatesBrieItemsOnTheSellDateWithMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 50, 0);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(-1, $item->getSellIn());
    }

    public function testItUpdatesBrieItemsAfterTheSellDate()
    {
        $item = GildedRose::of('Aged Brie', 10, -10);

        $item->tick();

        $this->assertSame(12, $item->getQuality());
        $this->assertSame(-11, $item->getSellIn());
    }

    public function testItUpdatesBriemItemsAfterTheSellDateWithMaximumQuality()
    {
        $item = GildedRose::of('Aged Brie', 50, -10);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(-11, $item->getSellIn());
    }

    public function testItUpdatesSulfurasItemsBeforeTheSellDate()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 5);

        $item->tick();

        $this->assertSame(80, $item->getQuality());
        $this->assertSame(5, $item->getSellIn());
    }

    public function testItUpdatesSulfurasItemsOnTheSellDate()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 0);

        $item->tick();

        $this->assertSame(80, $item->getQuality());
        $this->assertSame(0, $item->getSellIn());
    }

    public function testItUpdatesSulfurasItemsAfterTheSellDate()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, -1);

        $item->tick();

        $this->assertSame(80, $item->getQuality());
        $this->assertSame(-1, $item->getSellIn());
    }

    public function testItAlwaysReportsSulfurasQualityCorrectly()
    {
        $item = GildedRose::of('Sulfuras, Hand of Ragnaros', 10, 5);

        $this->assertSame(80, $item->getQuality());
    }

    public function testItUpdatesBackstagePassItemsLongBeforeTheSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 11);

        $item->tick();

        $this->assertSame(11, $item->getQuality());
        $this->assertSame(10, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsCloseToTheSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 10);

        $item->tick();

        $this->assertSame(12, $item->getQuality());
        $this->assertSame(9, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsCloseToTheSellDataAtMaxQuality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 50, 10);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(9, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsVeryCloseToTheSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 5);

        $item->tick();

        $this->assertSame(13, $item->getQuality()); // goes up by 3
        $this->assertSame(4, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsVeryCloseToTheSellDateAtMaxQuality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 50, 5);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(4, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsWithOneDayLeftToSell()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 1);

        $item->tick();

        $this->assertSame(13, $item->getQuality());
        $this->assertSame(0, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsWithOneDayLeftToSellAtMaxQuality()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 50, 1);

        $item->tick();

        $this->assertSame(50, $item->getQuality());
        $this->assertSame(0, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsOnTheSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, 0);

        $item->tick();

        $this->assertSame(0, $item->getQuality());
        $this->assertSame(-1, $item->getSellIn());
    }

    public function testItUpdatesBackstagePassItemsAfterTheSellDate()
    {
        $item = GildedRose::of('Backstage passes to a TAFKAL80ETC concert', 10, -1);

        $item->tick();

        $this->assertSame(0, $item->getQuality());
        $this->assertSame(-2, $item->getSellIn());
    }

    // public function testItUpdatesConjuredItemsBeforeTheSellDate()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 10, 10);

    //     $item->tick();

    //     $this->assertSame(8, $item->getQuality());
    //     $this->assertSame(9, $item->getSellIn());
    // }

    // public function testItUpdatesConjuredItemsAtZeroQuality()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 0, 10);

    //     $item->tick();

    //     $this->assertSame(0, $item->getQuality());
    //     $this->assertSame(9, $item->getSellIn());
    // }

    // public function testItUpdatesConjuredItemsOnTheSellDate()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 10, 0);

    //     $item->tick();

    //     $this->assertSame(6, $item->getQuality());
    //     $this->assertSame(-1, $item->getSellIn());
    // }

    // public function testItUpdatesConjuredItemsOnTheSellDateAt0Quality()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 0, 0);

    //     $item->tick();

    //     $this->assertSame(0, $item->getQuality());
    //     $this->assertSame(-1, $item->getSellIn());
    // }

    // public function testItUpdatesConjuredItemsAfterTheSellDate()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 10, -10);

    //     $item->tick();

    //     $this->assertSame(6, $item->getQuality());
    //     $this->assertSame(-11, $item->getSellIn());
    // }

    // public function testItUpdatesConjuredItemsAfterTheSellDateAtZeroQuality()
    // {
    //     $item = GildedRose::of('Conjured Mana Cake', 0, -10);

    //     $item->tick();

    //     $this->assertSame(0, $item->getQuality());
    //     $this->assertSame(-11, $item->getSellIn());
    // }
}
