<?php namespace BoundedContext\Contracts\Event\Snapshot;

use BoundedContext\Contracts\Core\Loggable;
use BoundedContext\Contracts\Schema\Schema;

interface Factory
{
    /**
     * Returns a new Snapshot from an Event.
     *
     * @param Loggable $loggable
     * @return Snapshot $snapshot
     */

    public function loggable(Loggable $loggable);

    /**
     * Returns a new Snapshot from a Schema.
     *
     * @param Schema $schema
     * @return Snapshot $snapshot
     */

    public function schema(Schema $schema);
}
