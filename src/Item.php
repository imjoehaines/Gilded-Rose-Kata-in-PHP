<?php

namespace App;

interface Item
{
    public function __construct(int $quality, int $sellIn);

    public function tick();
}
