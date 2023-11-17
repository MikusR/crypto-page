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

    public function search(array $vars): Response
    {
//        if (!isset($_GET['coinpair'])) {
//            return new Response('error', []);
//        };
        $term = strtoupper($_GET['coinpair']);
        $term = ($this->api->get($term)->getSymbol()) ?? "BTCUSDT";
        return new Response(
            "Search\\results", [
                "coinPairs" => new CoinPairCollection([
                    $this->api->get($term)
                ])
            ]
        );
    }
}