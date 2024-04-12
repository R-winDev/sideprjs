<?php

class Pangram
{
    public function __construct(string $sentence)
    {
        $this->isPangram($sentence);
    }

    protected function isPangram($sentence)
    {
        return empty
            (
            array_diff
                (
                range('a', 'z'),
                str_split(strtolower($sentence))
                )
            );
    }
}