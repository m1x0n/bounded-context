<?php namespace BoundedContext\Command;

use BoundedContext\Contracts\Command\Command;
use EventSourced\ValueObject\ValueObject\Type\AbstractEntity;

class AbstractCommand extends AbstractEntity implements Command
{
    public function aggregate_type_id()
    {
        return $this->id;
    }
}
