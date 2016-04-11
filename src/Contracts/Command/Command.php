<?php namespace BoundedContext\Contracts\Command;

use BoundedContext\Contracts\Core\Identifiable;
use EventSourced\ValueObject\Contracts\ValueObject;

interface Command extends Identifiable, ValueObject
{

}
