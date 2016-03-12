<?php namespace BoundedContext\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Schema\Schema;
use BoundedContext\ValueObject\Integer;

class Factory implements \BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Factory
{
    private $identifier_generator;
    private $datetime_generator;

    public function __construct(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator
    )
    {
        $this->identifier_generator = $identifier_generator;
        $this->datetime_generator = $datetime_generator;
    }

    public function create(Identifier $aggregate_id, Identifier $aggregate_type_id)
    {
        return new Snapshot(
            $aggregate_id,
            $aggregate_type_id,
            new Integer(),
            $this->datetime_generator->now(),
            new Schema()
        );
    }

    public function tree(array $tree)
    {
        return new Snapshot(
            $this->identifier_generator->string($tree['aggregate_id']),
            $this->identifier_generator->string($tree['aggregate_type_id']),
            new Integer($tree['version']),
            $this->datetime_generator->string($tree['occurred_at']),
            new Schema($tree['state'])
        );
    }

    public function state(State $state)
    {
        return new Snapshot(
            $state->aggregate_id(),
            $state->aggregate_type_id(),
            $state->version(),
            $this->datetime_generator->now(),
            new Schema($state->queryable()->serialize())
        );
    }
}
