<?php namespace BoundedContext\Event;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Serializable\AbstractIdentifiedSerializable;
use BoundedContext\Contracts\ValueObject\Identifier;

class AbstractEvent extends AbstractIdentifiedSerializable implements Event
{
    private $aggregate_type_id;
    
    public function aggregate_type_id()
    {
        return $this->aggregate_type_id;
    }

    public function set_aggregate_type_id(Identifier $type_id)
    {
        $this->aggregate_type_id = $type_id;
    }
}
