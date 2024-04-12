<?php

class Clock
{
    protected $hour = 0;
    protected $minute = 0;

    public function __construct($hr, $min)
    {
        $this->hour = $hr;
        $this->minute = $min;
        $this->genTime();
    }

    public function __toString()
    {
        return "$this->hour:$this->minute";
    }

    public function addMinute($min)
    {
        $this->minute += $min;
        $this->genTime();
        return $this;
    }

    public function subMinute($min)
    {
        $this->minute -= $min;
        $this->genTime();
        return $this;
    }

    protected function genTime()
    {
        while ($this->minute >= 60)
        {
            $this->minute -= 60;
            $this->hour++;
        }

        while ($this->minute < 0)
        {
            $this->minute += 60;
            $this->hour--;
        }

        while ($this->hour >= 24)
        {
            $this->hour -= 24;
        }

        while ($this->hour < 0)
        {
            $this->hour += 24;
        }
    }

}