
<?php

class QueenAttack
{
    public $xCoordinate, $yCoordinate;

    public function __construct($xInput, $yInput)
    {
        // Code ...
    }

    public function placeQueen ($xCoordinate, $yCoordinate)
    {
        if ($xCoordinate < 0 || $yCoordinate < 0)
        {
            throw new InvalidArgumentException("The input numbers must be positive");
        }
        if ($xCoordinate >= 0 && $xCoordinate <= 7)
        {
            if ($yCoordinate >= 0 && $yCoordinate <= 7)
            {
                return true;
            }
        }
        throw new InvalidArgumentException("The position must be on a standard size chess board!");
        return false;
    }

    public function canAttack($whiteQueen, $blackQueen)
    {
        if ($whiteQueen[0] === $blackQueen[0])
        {
            return true;
        }
        if ($whiteQueen[1] === $blackQueen[1])
        {
            return true;
        }
        if ($this->onDiagnol($whiteQueen, $blackQueen))
        {
            return true;
        }

        return false;
    }

    function onDiagnol (array $whiteQueen, array $blackQueen)
    {
        return abs($blackQueen[1] - $whiteQueen[1] === abs($blackQueen[0] - $whiteQueen[0]));
    }
}

