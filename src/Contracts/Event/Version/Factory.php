<?php namespace BoundedContext\Contracts\Event\Version;

use BoundedContext\Contracts\Core\Loggable;
use EventSourced\ValueObject\ValueObject\Integer as Integer_;

interface Factory
{
    /**
     * Returns a new Snapshot from an Event.
     *
     * @param Loggable $loggable
     * @return Integer_ $version
     */

    public function loggable(Loggable $loggable);
}
