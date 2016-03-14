<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Core\Resetable;

interface Command extends Resetable
{
    /**
     * Appends an Commands to the end of the Log.
     *
     * @param Command $command
     * @return void
     */
    public function append(Command $command);
}
