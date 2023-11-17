<?php

namespace App\Api;

use App\Models\CoinPair;
use App\Models\CoinPairCollection;

class Binance
{
    public static function get(): CoinPairCollection
    {
        $json = json_decode(
            file_get_contents(
//                "https://api4.binance.com/api/v3/ticker/24hr"
                __DIR__ . "/24hr.json"
            )
        );

        $coinPairs = [];
        foreach ($json as $pair) {
            $coinPairs[$pair->symbol] = new CoinPair(
                $pair->symbol,
                $pair->priceChange,
                $pair->highPrice,
                $pair->lowPrice
            );
        }
        return new CoinPairCollection($coinPairs);
    }


}