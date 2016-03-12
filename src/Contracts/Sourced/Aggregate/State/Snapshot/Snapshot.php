<?php namespace BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot;

use BoundedContext\Contracts\ValueObject\Identifier;
use BoundedContext\Contracts\Schema\Schema;

interface Snapshot extends \BoundedContext\Contracts\Snapshot\Snapshot
{
    /**
     * @return Identifier
     */
    public function aggregate_id();
    
    /**
     * @return Identifier
     */
    public function aggregate_type_id();
    
    
    /**
     * Gets the schema for the current Snapshot.
     *
     * @return Schema
     */
    public function schema();
}
