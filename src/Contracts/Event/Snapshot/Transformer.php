<?php namespace BoundedContext\Contracts\Event\Snapshot;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Schema\Schema;

interface Transformer
{
    public function fromEvent(Event $event);

    public function fromSchema(Schema $schema);

    public function toPopo($snapshot);

    public function fromPopo($popo);
}