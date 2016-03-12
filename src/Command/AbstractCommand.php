<?php namespace BoundedContext\Command;

use BoundedContext\Contracts\Command\Command;
use BoundedContext\Serializable\AbstractIdentifiedSerializable;

class AbstractCommand extends AbstractIdentifiedSerializable implements Command
{
    public function aggregate_type_id()
    {
        return $this->id;
    }
}
