<?php namespace BoundedContext\Event;

use BoundedContext\Contracts\Event\Event;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use EventSourced\ValueObject\ValueObject\Type\AbstractComposite;
use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;

class Event extends AbstractEntity implements Event
{
    protected $root_entity_id;
    protected $command_id;
    protected $aggregate_type_id;
    protected $values;
        
    public function __construct(
        Identifier $id, 
        Identifier $command_id,
        Identifier $aggregate_type_id,
        Identifier $root_entity_id, 
        AbstractComposite $values)
    {
        parent::__construct($id);
        $this->root_entity_id = $root_entity_id;
        $this->aggregate_type_id = $aggregate_type_id;
        $this->command_id = $command_id;
        $this->values = $values;
    }
    
    public function root_entity_id()
    {
        return $this->root_entity_id;
    }
    
    public function command_id()
    {
        return $this->command_id;
    }

    public function values()
    {
        return $this->values;
    }

    public function aggregate_type_id()
    {
        return $this->aggregate_type_id;
    }
}
