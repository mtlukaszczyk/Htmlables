<?php

namespace Lukaszczyk\Htmlables;

use Stringable;

class HtmlTag
{
    protected string|Stringable $content;

    protected string $tagName = 'div';

    protected string $style = '';

    protected array $props = [];

    public function __construct(
        string|Stringable $content,
        string $tagName = 'div',
        string $style = '',
        array $props = []
    )
    {
        $this->content = $content;
        $this->tagName = $tagName;
        $this->style = $style;
        $this->props = $props;
    }

    public function toHtml(): string
    {
        $propsString = '';

        foreach($this->props as $propName => $value) {
            $propsString .= $propName . '="' . $value . '" ';
        }

        return '<' . $this->tagName . ' ' . trim($propsString) . ' style="' . $this->style . '">' . $this->content . '</' . $this->tagName . '>';
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }
}
