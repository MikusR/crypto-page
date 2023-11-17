<?php

declare(strict_types=1);

namespace App;

use App\Api\Binance;
use App\Models\CoinPairCollection;

class Application
{
    private CoinPairCollection $pairCollection;

    public function run(): void
    {
        $this->pairCollection = Binance::get();
        var_dump($this->pairCollection);
//        while (true) {
//            echo "enter coin pair\n";
//            $choice = readline();
//            if (strlen($choice) <= 3) {
//                $choice = strtoupper($choice) . 'BTC';
//            }
//            echo ($this->pairCollection->get(strtoupper($choice))) ?? 'No such coin';
//            echo "\n";
//
//        }
    }
}