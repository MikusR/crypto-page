<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Api\Binance;
use App\Models\CoinPairCollection;
use App\Response;

class CoinPairController
{
    private Binance $api;

    public function __construct()
    {
        $this->api = new Binance();
    }

    public function index(array $vars): Response
    {
        return new Response(
            "Home\\index", [
                "coinPairs" => new CoinPairCollection([
                    $this->api->get("ETHBTC"),
                    $this->api->get("BTCUSDT"),
                    $this->api->get("LTCETH")
                ])
            ]
        );
    }
}