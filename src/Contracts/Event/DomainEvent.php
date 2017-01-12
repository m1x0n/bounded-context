<?php namespace BoundedContext\Contracts\Event;

/**
 * A domain event, that contains information relevant to the domain
 */
interface DomainEvent extends ValueObject
{
    public function version();
}
