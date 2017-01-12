<?php namespace BoundedContext\Event;

class AbstractEvent implements \BoundedContext\Contracts\Event\DomainEvent
{

    public function version()
    {
        return 1;
    }
}