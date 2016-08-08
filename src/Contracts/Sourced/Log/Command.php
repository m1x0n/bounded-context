<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Core\Resetable;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;

interface Command extends Resetable
{
    /**
     * Appends an Commands to the end of the Log.
     *
     * @param Command $command
     * @return void
     */
    public function append(Command $command);
    
    /** 
     * ID of the last command to be appended
     * 
     * @return Identifier
     */
    public function last_id();
}
