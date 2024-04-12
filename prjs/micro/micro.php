<?php 

class MicroBlog
{
    public function __construct(string $text)
    {
        $this->truncate($text);
    }

    protected function truncate(string $text)
    {
        return mb_substr($text, 0, 5);
    }
}