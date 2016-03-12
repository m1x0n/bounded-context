<?php namespace BoundedContext\Snapshot;

use BoundedContext\Contracts\ValueObject\DateTime;
use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\ValueObject\AbstractValueObject;
use BoundedContext\ValueObject\Integer as Version;

abstract class AbstractSnapshot extends AbstractValueObject
{
    public $aggregate_id;
    public $aggregate_type_id;
    public $version;
    public $occurred_at;

    public function __construct(
        Version $version,
        DateTime $occurred_at
    )
    {
        $this->version = $version;
        $this->occurred_at = $occurred_at;
    }

    public function version()
    {
        return $this->version;
    }

    public function occurred_at()
    {
        return $this->occurred_at;
    }
}
