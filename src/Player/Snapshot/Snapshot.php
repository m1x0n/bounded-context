<?php namespace BoundedContext\Player\Snapshot;

use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use EventSourced\ValueObject\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Snapshot\AbstractSnapshot;
use EventSourced\ValueObject\ValueObject\Integer as Version;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Player\Snapshot\Snapshot
{
    public $id;
    public $last_id;

    public function __construct(
        Identifier $id,
        Version $version,
        DateTime $occurred_at,
        Identifier $last_id
    )
    {
        parent::__construct($version, $occurred_at);
        $this->id = $id;
        $this->last_id = $last_id;
    }

    public function last_id()
    {
        return $this->last_id;
    }

    public function reset(
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator
    )
    {
        return new Snapshot(
            $this->id,
            $this->version->reset(),
            $datetime_generator->now(),
            $identifier_generator->null()
        );
    }

    public function skip(
        Identifier $next_id,
        DateTimeGenerator $datetime_generator
    )
    {
        return new Snapshot(
            $this->id,
            $this->version,
            $datetime_generator->now(),
            $next_id
        );
    }

    public function take(
        Identifier $next_id,
        DateTimeGenerator $datetime_generator
    )
    {
        return new Snapshot(
            $this->id,
            $this->version->increment(),
            $datetime_generator->now(),
            $next_id
        );
    }

    public function id()
    {
        return $this->id;
    }

}
