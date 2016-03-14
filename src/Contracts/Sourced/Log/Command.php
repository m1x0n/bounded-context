<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Command\Command;

interface Event extends Log
{
    /**
     * Appends an Commands to the end of the Log.
     *
     * @param Command $command
     * @return void
     */
    public function append(Command $command);

    /**
     * Appends a Collection of Commands to the end of the Log.
     *
     * @param Collection $commands
     * @return void
     */
    public function append_collection(Collection $commands);
}
