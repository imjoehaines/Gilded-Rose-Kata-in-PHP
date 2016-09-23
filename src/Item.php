<?php

namespace App;

interface Item
{
    public function __construct(int $quality, int $sellIn);

    public function tick();

    public function getName() : string;

    public function getQuality() : int;

    public function getSellIn() : int;
}
