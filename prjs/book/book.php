<?php

class BookDiscount
{
    public const PRICE = 8;
    public const DISCOUNT = 
    [
        2 => 0.05, // 5 %
        3 => 0.1, // 10 %
        4 => 0.2, // 20%
        5 => 0.25, // 25 %
    ];

    public function __construct($basket)
    {
        $this->total($basket);
    }

    protected function total (array $basket)
    {
        return $this->price(array_count_values($basket));
    }

    protected function price(array $counts)
    {
        $results = [];
        $max = count($counts);
        for ($n = 1; $n <= $max; $n++)
        {
            $discount = self::PRICE - (self::PRICE * (float) (self::DISCOUNT[$n] ?? 0));
            $results[] = $n * $discount + $this->price($this->decr($counts, $n));
        }

        return empty($counts) ? 0 : min($results);
    }

    protected function decr(array $array, int $n)
    {
        assert(array_filter($array) === $array);
        while ($n-- > 0)
        {
            --$array[key($array)];
            next($array);
        }

        return array_filter($array);
    }
}