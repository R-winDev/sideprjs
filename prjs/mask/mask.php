<?php 

class Mask
{
    public function __construct($input)
    {
        $this->mask($input);
    }

    protected function mask(string $input)
    {
        if (strlen($input) <= 6 )
        {
            return $input;
        }

        for ($i = 1; $i < strlen($input) - 4; $i++)
        {
            if ($input[$i] != '-')
            {
                $input[$i] = '#';
            }
        }

        return $input;
    }
}