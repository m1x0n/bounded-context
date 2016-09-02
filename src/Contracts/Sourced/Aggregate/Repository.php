<?php namespace BoundedContext\Contracts\Sourced\Aggregate;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Sourced\Log;

interface Repository {

    /**
     * Returns an Aggregate for a Command.
     *
     * @param Command $command
     * @return Aggregate
     */
    public function by(Command $command);

    /**
     * Saves an Aggregate to the Repository.
     *
     * @param Aggregate $aggregate
     * @return void
     */
    public function save(Aggregate $aggregate);

    /**
     * @return Log\Event
     */
    public function event_log();
}
