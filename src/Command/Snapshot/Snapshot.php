<?php namespace BoundedContext\Command\Snapshot;

use BoundedContext\Contracts\Schema\Schema;
use EventSourced\ValueObject\Contracts\ValueObject\DateTime;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use BoundedContext\Snapshot\AbstractSnapshot;
use EventSourced\ValueObject\ValueObject\Integer as Integer_;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Command\Snapshot\Snapshot
{
    protected $type_id;
    protected $type;
    protected $aggregate_type_id;
    protected $event;

    public function __construct(
        Integer_ $version,
        DateTime $occurred_at,
        Identifier $type_id,
        Schema $event
    )
    {
        parent::__construct($version, $occurred_at);
        $this->type_id = $type_id;
        $this->event = $event;
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
