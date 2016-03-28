<?php namespace BoundedContext\Event\Snapshot;

use BoundedContext\Contracts\Core\Identifiable;
use BoundedContext\Contracts\Schema\Schema;
use EventSourced\ValueObject\Contracts\ValueObject\DateTime;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use EventSourced\ValueObject\ValueObject\Integer as Integer_;

class Snapshot extends AbstractSnapshot implements Identifiable, \BoundedContext\Contracts\Event\Snapshot\Snapshot
{
    protected $id;
    protected $type_id;
    protected $event;

    public function __construct(
        Identifier $id,
        Integer_ $version,
        DateTime $occurred_at,
        Identifier $type_id,
        Schema $event
    )
    {
        parent::__construct($version, $occurred_at);
        $this->id = $id;
        $this->type_id = $type_id;
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

    public function schema()
    {
        return $this->event;
    }
}
