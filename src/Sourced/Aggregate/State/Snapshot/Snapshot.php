<?php namespace BoundedContext\Sourced\Aggregate\State\Snapshot;

use EventSourced\ValueObject\Contracts\ValueObject\DateTime;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use BoundedContext\Schema\Schema;
use BoundedContext\Snapshot\AbstractSnapshot;
use EventSourced\ValueObject\ValueObject\Integer as Version;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Snapshot
{
    protected $schema;

    public function __construct(
        Identifier $aggregate_id,
        Identifier $aggregate_type_id,
        Version $version,
        DateTime $occurred_at,
        Schema $schema
    )
    {
        parent::__construct($version, $occurred_at);
        $this->aggregate_id = $aggregate_id;
        $this->aggregate_type_id = $aggregate_type_id;
        $this->schema = $schema;
    }
    
    public function aggregate_id()
    {
        return $this->aggregate_id;
    }
    
    public function aggregate_type_id()
    {
        return $this->aggregate_type_id;
    }

    public function schema()
    {
        return $this->schema;
    }
}
