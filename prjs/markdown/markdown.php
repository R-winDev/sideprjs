<?php

class Markdown
{
    public function __construct($markdown)
    {
        $this->parseMarkdown($markdown);
    }

    protected function parseMarkdown(string $markdown)
    {
        $listStarted = false;
        $lines = explode("\n", $markdown);
    
        foreach ($lines as &$line) {
            if (preg_match('/^(#{1,6})(.*)/', $line, $matches)) {
                $tag = 'h' . strlen($matches[1]);
                $line = "<$tag>" . trim($matches[2]) . "</$tag>";
            }
    
            if (preg_match('/\*(.*)/', $line, $matches)) {
                $startTag = '<li>';
                $endTag = '</li>';
    
                if (!$listStarted) {
                    $listStarted = true;
                    $startTag = '<ul><li>';
                }
    
                if (!$this->parseMarkdownInline($matches[1])) {
                    $startTag = "$startTag<p>";
                    $endTag = "</p>$endTag";
                }
    
                $line = "$startTag" . trim($matches[1]) . $endTag;
    
            } elseif ($listStarted) {
                $line = "</ul>$line";
                $listStarted = false;
            }
    
            if (!preg_match('/<h|<ul|<p|<li/', $line)) {
                $line = "<p>$line</p>";
            }
    
            $this->parseMarkdownInline($line);
        }
        $html = join($lines);
        if ($listStarted) {
            $html .= '</ul>';
        }
        return $html;
    }

    protected function parseMarkdownInline(string $line)
    {
        static $patterns  = 
        [
            'em' => '/(.*)__(.*)__(.*)/',
            'i' => '/(.*)_(.*)_(.*)/',
        ];

        $result = false;
        foreach ($patterns as $tag=>$pattern)
        {
            if (preg_match($pattern, $line, $matches))
            {
                $line = $matches[1] . "<$tag>" . $matches[2] . "</$tag>" .  $matches[3];
                $result = true;
            }
        }

        return $result;
    }
}