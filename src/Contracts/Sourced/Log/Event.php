<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Event\Event;

interface Event extends Log
{
    /**
     * Appends an Event to the end of the Log.
     *
     * @param Event $event
     * @return void
     */
    public function append(Event $event);

    /**
     * Appends a Collection of Events to the end of the Log.
     *
     * @param Collection $events
     * @return void
     */
    public function append_collection(Collection $events);
}
