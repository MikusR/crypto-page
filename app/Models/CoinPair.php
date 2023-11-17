<?php

namespace App\Models;

class CoinPair
{
    private string $symbol;
    private float $priceChange;
    private float $highPrice;
    private float $lowPrice;

    public function __construct(
        string $symbol,
        float $priceChange,
        float $highPrice,
        float $lowPrice
    ) {
        $this->symbol = $symbol;
        $this->priceChange = $priceChange;
        $this->highPrice = $highPrice;
        $this->lowPrice = $lowPrice;
    }


    public function getSymbol(): string
    {
        return $this->symbol;
    }


    public function getPriceChange(): float
    {
        return $this->priceChange;
    }

    public function getHighPrice(): float
    {
        return $this->highPrice;
    }


    public function getLowPrice(): float
    {
        return $this->lowPrice;
    }
}