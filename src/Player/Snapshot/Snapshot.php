<?php namespace BoundedContext\Player\Snapshot;

use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use EventSourced\ValueObject\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\Generator\DateTime as DateTimeGenerator;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use BoundedContext\Snapshot\AbstractSnapshot;
use EventSourced\ValueObject\ValueObject\Integer as Version;

class Snapshot extends AbstractSnapshot implements \BoundedContext\Contracts\Player\Snapshot\Snapshot
{
    public $last_id;
    private $class_name;

    public function __construct(
        ClassName $class_name,
        Version $version,
        DateTime $occurred_at,
        Identifier $last_id
    )
    {
        parent::__construct($version, $occurred_at);
        $this->class_name = $class_name;
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
            $this->class_name,
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
            $this->class_name,
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
            $this->class_name,
            $this->version->increment(),
            $datetime_generator->now(),
            $next_id
        );
    }

    public function class_name()
    {
        return $this->class_name;
    }

    public static function make(
        ClassName $class_name,
        IdentifierGenerator $identifier_generator,
        DateTimeGenerator $datetime_generator
    )
    {
        return new Snapshot(
            $class_name,
            new Version(1),
            $datetime_generator->now(),
            $identifier_generator->null()
        );
    }
}
