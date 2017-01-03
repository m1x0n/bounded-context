<?php namespace BoundedContext\Sourced\Stream;

use BoundedContext\Contracts\Sourced\Stream\Stream;
use BoundedContext\Schema\Schema;
use BoundedContext\Event\AggregateType;
use BoundedContext\Event\Snapshot\Snapshot;
use EventSourced\ValueObject\ValueObject\Uuid;
use EventSourced\ValueObject\ValueObject\Integer as Integer_;
use EventSourced\ValueObject\ValueObject\DateTime;
use BoundedContext\Event;

class SnapshotStream implements Stream
{
    private $stream;

    public function __construct(Stream $stream)
    {
        $this->stream = $stream;
    }

    public function current()
    {
        $popo = $this->stream->current();

        if (!$popo) {
            return null;
        }

        return $this->popo_to_event_snapshot($popo);
    }

    private function popo_to_event_snapshot($popo)
    {
        return new Snapshot(
            new Uuid($popo->id),
            new Integer_($popo->version),
            new DateTime($popo->occured_at),
            new Event\Type($popo->type),
            new Uuid($popo->command_id),
            new Uuid($popo->aggregate_id),
            new AggregateType($popo->aggregate_type),
            new Schema((array)$popo->event)
        );
    }

    public function next()
    {
        return $this->stream->next();
    }

    public function key()
    {
        return $this->stream->key();
    }

    public function valid()
    {
        return $this->stream->current();
    }

    public function rewind()
    {
        //$this->stream->rewind();
    }
}