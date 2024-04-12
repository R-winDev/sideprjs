<?php


class Robot
{
    public const dirNorth = 'north';
    public const dirEast = 'east';
    public const dirSouth = 'south';
    public const dirWest = 'west';


    public const Xposition = 0;
    public const Yposition = 0;

    /** 
     * @var int[]
     */
    protected $position;

    /**
     * @var string
     */
    protected $direction;

    public function __construct(array $position, string $direction)
    {
        $this->position = $position;
        $this->direction = $direction;
    }

    public function __get($name)
    {
        if ($name === 'direction')
        {
            return $this->direction;
        }
        if ($name === 'position')
        {
            return $this->position;
        }
    }

    public function turnRight()
    {
        if ($this->direction === self::dirNorth)
        {
            $this->direction = self::dirEast;
            return $this;
        }
        if ($this->direction === self::dirEast)
        {
            $this->direction = self::dirSouth;
            return $this;
        }
        if ($this->direction === self::dirSouth)
        {
            $this->direction = self::dirWest;
            return $this;
        }
        if ($this->direction === self::dirWest)
        {
            $this->direction = self::dirNorth;
            return $this;
        }

        return $this;
    }

    public function turnLeft()
    {
        if ($this->direction === self::dirNorth)
        {
            $this->direction = self::dirWest;
            return $this;
        }
        if ($this->direction === self::dirWest)
        {
            $this->direction = self::dirSouth;
            return $this;
        }
        if ($this->direction === self::dirSouth)
        {
            $this->direction = self::dirEast;
            return $this;
        }
        if ($this->direction === self::dirEast)
        {
            $this->direction = self::dirNorth;
            return $this;
        }

        return $this;
    }

    public function moveAdvance()
    {
        if ($this->direction === self::dirNorth)
        {
            $this->position[self::Yposition]++;
            return $this;
        }
        if ($this->direction === self::dirSouth)
        {
            $this->position[self::Yposition]--;
            return $this;
        }
        if ($this->direction === self::dirEast)
        {
            $this->position[self::Xposition]++;
            return $this;
        }
        if ($this->direction === self::dirWest)
        {
            $this->position[self::Xposition]--;
            return $this;
        }

        return $this;
    }

    public function command(string $command)
    {
        $commandArray = str_split($command);

        array_map(
            function ($command)
            {
                if (!in_array($command, ['L', 'R', 'A']))
                {
                    throw new InvalidArgumentException("Invalid commands: ".$command);
                }
            },
            $commandArray
        );

        foreach ($commandArray as $cmd)
        {
            if ($cmd === 'L')
            {
                $this->turnLeft();
            }
            if ($cmd === 'R')
            {
                $this->turnRight();
            }
            if ($cmd === 'A')
            {
                $this->moveAdvance();
            }
        }

        return $this;
    }
}