<?php namespace BoundedContext\Contracts\Event;

use BoundedContext\Contracts\Core\Identifiable;
use EventSourced\ValueObject\Contracts\ValueObject;

interface Event extends Identifiable, ValueObject
{
    /**
     * @return Identifier
     */
    public function aggregate_type_id();
}
