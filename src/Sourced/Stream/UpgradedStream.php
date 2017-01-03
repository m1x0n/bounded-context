<?php namespace BoundedContext\Sourced\Stream;

use BoundedContext\Contracts\Sourced\Stream\Stream;


class UpgradedStream implements Stream
{
    private $stream;
    private $upgrader;

    private $upgraded;

    public function __construct(Stream $stream, $upgrader)
    {
        $this->stream = $stream;
        $this->upgrader = $upgrader;
    }

    public function current()
    {
        $event = $this->stream->next();

        if (!$event) {
            return null;
        }

        $this->upgraded = $this->upgrader->upgrade($event);
    }

    public function next()
    {

    }

    public function key()
    {
        // TODO: Implement key() method.
    }

    public function valid()
    {
        // TODO: Implement valid() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }
}