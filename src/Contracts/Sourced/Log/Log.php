<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Sourced\Stream\Builder;

interface Log extends Resetable
{
    /**
     * Returns a new Stream Builder for the Log.
     *
     * @return Builder
     */
    public function builder();
}
