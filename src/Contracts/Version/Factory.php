<?php namespace BoundedContext\Contracts\Version;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Integer;

interface Factory
{
    /**
     * Returns the version from an Event.
     *
     * @param Event $event
     * @return Integer $version
     */
    public function event(Event $event);
    
    /**
     * Returns the version from a command.
     *
     * @param Command $command
     * @return Integer $version
     */
    public function command(Command $command);
}
