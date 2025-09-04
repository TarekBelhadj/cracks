<?php

/**
 * Description of Markdown
 *
 * @author 
 */
class Markdown {
    public static function get(string $content): Markdown {
        return new Markdown($content);
    }
    
    public static function _(string $c) { return static::get($c)->parse(); }
    
    public function __construct(protected string $content){}
    
    public function parse(): string {
        $returns = $this->content;
        // bold, italic, striken, underlined
        $returns = preg_replace('`\*\*(.+)\*\*`', '<b>$1</b>', $returns);
        $returns = preg_replace('`\*(.+)\*`', '<i>$1</i>', $returns);
        $returns = preg_replace('`~~(.+)~~`', '<del>$1</del>', $returns);
        $returns = preg_replace('`__(.+)__`', '<ins>$1</ins>', $returns);
        // autolinks
        $returns = preg_replace('`http(s?)://(\S+)`', '<a href="$0">$0</a>', $returns);
        $returns = preg_replace('`([a-zA-Z0-9])(([\-.]|[_]+)?([a-zA-Z0-9]+))*(@){1}[a-z0-9]+[.]{1}(([a-z]{2,3})|([a-z]{2,3}[.]{1}[a-z]{2,3}))`', '<a href="mailto:$0">$0</a>', $returns);
        return $returns;
    }
}