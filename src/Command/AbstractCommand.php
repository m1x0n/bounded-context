<?php namespace BoundedContext\Command;

use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;
use EventSourced\ValueObject\ValueObject\Uuid;

class AbstractCommand extends AbstractEntity implements Command
{
    protected $root_entity_id;
    
    public function __construct(Uuid $id, Uuid $root_entity_id)
    {
        $this->root_entity_id = $root_entity_id;
        parent::__construct($id);
    }
    
    public function aggregate_type_id()
    {
        return $this->id;
    }
    
    public function root_entity_id()
    {
        return $this->root_entity_id;
    }
}
