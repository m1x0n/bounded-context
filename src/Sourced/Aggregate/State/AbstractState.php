<?php namespace BoundedContext\Sourced\Aggregate\State;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Projection\Projection;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Event\Applying;
use BoundedContext\ValueObject\AbstractValueObject;
use BoundedContext\ValueObject\Integer as Version;

abstract class AbstractState extends AbstractValueObject implements State
{
    use Applying;

    protected $aggregate_id;
    protected $aggregate_type_id;

    public function __construct(
        Identifier $aggregate_id,
        Identifier $aggregate_type_id,
        Version $version,
        Projection $projection
    )
    {
        $this->aggregate_id = $aggregate_id;
        $this->aggregate_type_id = $aggregate_type_id;
        $this->version = $version;
        $this->projection = $projection;
    }

    public function aggregate_id()
    {
        return $this->aggregate_id;
    }
    
    public function aggregate_type_id()
    {
        return $this->aggregate_type_id;
    }

    public function version()
    {
        return $this->version;
    }

    public function apply(Event $event)
    {
        $this->mutate($event);
    }

    public function queryable()
    {
        return $this->projection;
    }
}
