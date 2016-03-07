<?php namespace BoundedContext\Contracts\Snapshot;

use BoundedContext\Contracts\Core\Collectable;
use BoundedContext\Contracts\Core\Temporal;
use BoundedContext\Contracts\Core\Versionable;
use BoundedContext\Contracts\ValueObject\ValueObject;

interface Snapshot extends Versionable, Collectable, Temporal, ValueObject
{

}
