<?php

declare(strict_types=1);

namespace App;

use App\Models\CoinPairCollection;

class Response
{
    private string $viewName;
    private array $CoinPairData;

    public function __construct(string $viewName, array $CoinPairData)
    {
        $this->viewName = $viewName;
        $this->CoinPairData = $CoinPairData;
    }


    public function view(): string
    {
        return $this->viewName;
    }

    public function coinPairs(): array
    {
        return $this->CoinPairData;
    }
}