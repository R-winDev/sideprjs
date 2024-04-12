<?php

declare(strict_types=1);

class ZebraPuzzle
{
    protected string $waterDrinker = '';
    protected string $zebraOwner = '';

    protected const FIRST = 1;
    protected const MIDDLE = 3;

    protected int $red = 0;
    protected int $green = 0;
    protected int $ivory = 0;
    protected int $yellow = 0;
    protected int $blue = 0;

    protected int $englishman = 0;
    protected int $spaniard = 0;
    protected int $ukrainian = 0;
    protected int $japanese = 0;
    protected int $norwegian = 0;

    protected int $coffee = 0;
    protected int $tea = 0;
    protected int $milk = 0;
    protected int $orangeJuice = 0;
    protected int $water = 0;

    protected int $oldGold = 0;
    protected int $kools = 0;
    protected int $chesterfields = 0;
    protected int $luckyStrike = 0;
    protected int $parliaments = 0;

    protected int $dog = 0;
    protected int $snails = 0;
    protected int $fox = 0;
    protected int $horse = 0;
    protected int $zebra = 0;

    protected array $nationalityNames = [];

    protected array $possiblePermutations;

    public function __construct()
    {
        $this->possiblePermutations = $this->permuteValues([1, 2, 3, 4, 5]);
        $this->solve();
    }

    public function waterDrinker(): string
    {
        return $this->waterDrinker;
    }

    public function zebraOwner(): string
    {
        return $this->zebraOwner;
    }

    protected function permuteValues(array $array): array
    {
        $result = [];

        $length = count($array);

        if ($length === 0) {
            return [[]];
        }

        foreach ($array as $index => $value) {
            $rest = $this->permuteValues(array_merge(array_slice($array, 0, $index), array_slice($array, $index + 1)));

            if (empty($rest)) {
                $result[] = [$value];
            } else {
                foreach ($rest as $r) {
                    $result[] = array_merge([$value], $r);
                }
            }
        }

        return $result;
    }

    protected function isRightOf($houseA, $houseB): bool
    {
        return $houseA - 1 === $houseB;
    }

    protected function nextTo($houseA, $houseB): bool
    {
        return $this->isRightOf($houseA, $houseB) || $this->isRightOf($houseB, $houseA);
    }

    protected function solve(): void
    {
        foreach ($this->possiblePermutations as $permutation) {
            $this->solveHouseColors($permutation);
        }
    }

    protected function solveHouseColors($permutation): void
    {
        $this->red = $permutation[0];
        $this->green = $permutation[1];
        $this->ivory = $permutation[2];
        $this->yellow = $permutation[3];
        $this->blue = $permutation[4];

        if ($this->isRightOf($this->green, $this->ivory)) {     // Clue #6
            foreach ($this->possiblePermutations as $perm) {
                $this->solveNationalities($perm);
            }
        }
    }

    protected function solveNationalities($permutation): void
    {
        $this->englishman = $permutation[0];
        $this->spaniard = $permutation[1];
        $this->ukrainian = $permutation[2];
        $this->japanese = $permutation[3];
        $this->norwegian = $permutation[4];

        if (
            $this->red === $this->englishman &&             // Clue #2
            $this->norwegian === self::FIRST &&             // Clue #10
            $this->nextTo($this->norwegian, $this->blue)    // Clue #15
        ) {
            $this->nationalityNames[$this->englishman] = 'Englishman';
            $this->nationalityNames[$this->spaniard] = 'Spaniard';
            $this->nationalityNames[$this->ukrainian] = 'Ukrainian';
            $this->nationalityNames[$this->japanese] = 'Japanese';
            $this->nationalityNames[$this->norwegian] = 'Norwegian';

            foreach ($this->possiblePermutations as $perm) {
                $this->solveBeverages($perm);
            }
        }
    }

    protected function solveBeverages($permutation): void
    {
        $this->coffee = $permutation[0];
        $this->tea = $permutation[1];
        $this->milk = $permutation[2];
        $this->orangeJuice = $permutation[3];
        $this->water = $permutation[4];

        if (
            $this->coffee === $this->green &&       // Clue #4
            $this->ukrainian === $this->tea &&      // Clue #5
            $this->milk === self::MIDDLE            // Clue #9
        ) {
            foreach ($this->possiblePermutations as $perm) {
                $this->solveCigars($perm);
            }
        }
    }

    protected function solveCigars($permutation): void
    {
        $this->oldGold = $permutation[0];
        $this->kools = $permutation[1];
        $this->chesterfields = $permutation[2];
        $this->luckyStrike = $permutation[3];
        $this->parliaments = $permutation[4];

        if (
            $this->kools === $this->yellow &&               // Clue #8
            $this->luckyStrike === $this->orangeJuice &&    // Clue #13
            $this->japanese === $this->parliaments          // Clue #14
        ) {
            foreach ($this->possiblePermutations as $perm) {
                $this->solvePets($perm);
            }
        }
    }

    protected function solvePets($permutation): void
    {
        $this->dog = $permutation[0];
        $this->snails = $permutation[1];
        $this->fox = $permutation[2];
        $this->horse = $permutation[3];
        $this->zebra = $permutation[4];

        if (
            $this->spaniard === $this->dog &&                   // Clue #3
            $this->oldGold === $this->snails &&                 // Clue #7
            $this->nextTo($this->chesterfields, $this->fox) &&  // Clue #11
            $this->nextTo($this->kools, $this->horse)           // Clue #12
        ) {
            $this->waterDrinker = $this->nationalityNames[$this->water];
            $this->zebraOwner = $this->nationalityNames[$this->zebra];
        }
    }
}
