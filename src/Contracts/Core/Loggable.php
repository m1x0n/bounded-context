<?php namespace BoundedContext\Contracts\Core;

use EventSourced\ValueObject\Contracts\ValueObject;

interface Loggable extends Identifiable, ValueObject
{
    /**
     * @return Identifier
     */
    public function aggregate_type_id();
}
