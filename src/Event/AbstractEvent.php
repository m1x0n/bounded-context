<?php namespace BoundedContext\Event;

use BoundedContext\Contracts\Event\Event;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;

class AbstractEvent extends AbstractEntity implements Event
{
    protected $aggregate_type_id;
    
    public function aggregate_type_id()
    {
        return $this->aggregate_type_id;
    }

    public function set_aggregate_type_id(Identifier $type_id)
    {
        $this->aggregate_type_id = $type_id;
    }
}
