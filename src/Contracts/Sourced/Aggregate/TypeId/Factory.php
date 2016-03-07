<?php namespace BoundedContext\Contracts\Sourced\Aggregate\TypeId;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Factory
{
    /**
     * Returns a new Aggregate from its state.
     *
     * @param Command $command
     * @return Identifier
     */
    public function command(Command $command);
}
