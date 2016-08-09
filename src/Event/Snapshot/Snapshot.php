<?php namespace BoundedContext\Event\Snapshot;

use BoundedContext\Contracts\Schema\Schema;
use EventSourced\ValueObject\Contracts\ValueObject\DateTime;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use EventSourced\ValueObject\ValueObject\Integer as Integer_;
use BoundedContext\Event\Type as EventType;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Event\Snapshot\Snapshot
{
    protected $id;
    protected $type_id;
    protected $type;
    protected $command_id;
    protected $root_entity_id;
    protected $aggregate_type_id;
    protected $event;

    public function __construct(
        Identifier $id,
        Integer_ $version,
        DateTime $occurred_at,
        Identifier $type_id,
        EventType $type,
        Identifier $command_id,
        Identifier $root_entity_id,
        Identifier $aggregate_type_id,
        Schema $event
    )
    {
        parent::__construct($version, $occurred_at);
        $this->id = $id;
        $this->type_id = $type_id;
        $this->type = $type;
        $this->command_id = $command_id;
        $this->root_entity_id =  $root_entity_id;
        $this->aggregate_type_id = $aggregate_type_id;
        $this->event = $event;
    }
    
    public function id()
    {
        return $this->id;
    }

    public function type_id()
    {
        return $this->type_id;
    }

    public function type()
    {
        return $this->type;
    }
    
    public function command_id()
    {
        return $this->command_id;
    }
    
    public function root_entity_id()
    {
        return $this->root_entity_id;
    }
    
    public function aggregate_type_id()
    {
        return $this->aggregate_type_id;
    }

    public function schema()
    {
        return $this->event;
    }
}
