<?php

namespace Lukaszczyk\Htmlables;

use Stringable;
use \ArrayAccess;

class HtmlTemplate implements ArrayAccess
{
    private array $container;

    public function __construct(Stringable|string ...$container)
    {
        $this->container = $container;
    }

    public function addElement(Stringable $element)
    {
        $this->container[] = $element;
    }

    public function offsetExists(mixed $offset): bool
    {
        return isset($this->container[$offset]);
    }

    public function offsetGet(mixed $offset)
    {
        return $this->container[$offset] ?? null;
    }

    public function offsetSet(mixed $offset, mixed $value)
    {
        if (!$value instanceof Stringable) {
            throw new \Exception('Stringable required');
        }

        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetUnset(mixed $offset)
    {
        unset($this->container[$offset]);
    }

    public function toHtml(): string
    {
        return implode('', $this->container);
    }

    public function __toString(): string
    {
        return $this->toHtml();
    }
}
