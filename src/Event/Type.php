<?php namespace BoundedContext\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;

class Type extends AbstractSingleValue
{
    protected function validator()
    {
        return parent::validator()->alnum("_.")->noWhitespace()->lowercase();
    }
}

