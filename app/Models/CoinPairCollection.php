<?php

namespace App\Models;

class CoinPairCollection
{
    private array $coins;

    public function __construct($coinPairs = [])
    {
        foreach ($coinPairs as $coinPair) {
            $this->add($coinPair->getSymbol(), $coinPair);
        }
    }

    public function add(string $symbol, CoinPair $coinPair): void
    {
        $this->coins[$symbol] = $coinPair;
    }

    public function get(string $symbol): ?CoinPair
    {
        return ($this->coins[$symbol]) ?? null;
    }

    /**
     * @return CoinPair[]
     */
    public function list(): array
    {
        return $this->coins;
    }

}