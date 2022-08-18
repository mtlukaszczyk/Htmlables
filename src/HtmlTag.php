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
		
		$main = $this->tagName;
		
		if ($propsString !== '') {
			$main .= ' ' . trim($propsString);
		}
		
		if ($this->style !== '') {
			$main .= ' style="' . $this->style . '"';  
		}
		

        return '<' . $main . '>' . $this->content . '</' . $this->tagName . '>';
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }
}
