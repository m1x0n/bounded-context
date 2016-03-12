<?php namespace BoundedContext\Contracts\Sourced\Log;

use BoundedContext\Contracts\Collection\Collection;
use BoundedContext\Contracts\Core\Resetable;
use BoundedContext\Contracts\Core\Loggable;
use BoundedContext\Contracts\Sourced\Stream\Builder;

interface Log extends Resetable
{
    /**
     * Returns a new Stream Builder for the Log.
     *
     * @return Builder
     */
    public function builder();

    /**
     * Appends an Event to the end of the Log.
     *
     * @param Loggable $loggable
     * @return void
     */
    public function append(Loggable $loggable);

    /**
     * Appends a Collection of Loggables to the end of the Log.
     *
     * @param Collection $loggable
     * @return void
     */
    public function append_collection(Collection $loggable);
}
