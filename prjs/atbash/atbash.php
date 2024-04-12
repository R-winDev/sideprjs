<?php

class Atbash
{
    public $text;
    public function __construct(string $text)
    {
        $this->text = $this->coder($text);
    }

    function coder(string $text)
    {
        $alphabet = implode('', range('a', 'z'));
        $ciphers = strrev($alphabet);
        $input = preg_replace('/\W/', '', strtolower($text));
        $translation = strtr($input, $alphabet, $ciphers);
        return wordwrap($translation, 5, ' ', true);
    }
}