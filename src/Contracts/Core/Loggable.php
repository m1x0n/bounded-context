<?php namespace BoundedContext\Contracts\Core;

use BoundedContext\Contracts\ValueObject\ValueObject;

interface Loggable extends Identifiable, ValueObject
{
    /**
     * @return Identifier
     */
    public function aggregate_type_id();
}
