<?php namespace BoundedContext\Contracts\Sourced\Aggregate\TypeId;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\ValueObject\Identifier;

interface Factory
{
    /**
     * Returns the TypeID of an aggregate based on one of its commands
     *
     * @param Command $command
     * @return Identifier
     */
    public function command(Command $command);
    
    /**
     * Returns the TypeID of an aggregate based on its class path
     * 
     * @param string $aggregate_class
     * @return Identifier
     */
    public function aggregate_class($aggregate_class);
}
