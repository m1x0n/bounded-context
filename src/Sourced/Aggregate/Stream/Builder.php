<?php namespace BoundedContext\Sourced\Aggregate\Stream;

use BoundedContext\Contracts\Sourced\Aggregate\Stream\Factory as StreamFactory;
use BoundedContext\Contracts\Generator\Identifier as IdentifierGenerator;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;
use EventSourced\ValueObject\ValueObject\Integer;

class Builder implements \BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder
{
    private $stream_factory;

    private $aggregate_id;
    private $aggregate_type_id;
    private $version;
    private $limit;
    private $chunk_size;

    public function __construct(
        IdentifierGenerator $generator,
        StreamFactory $stream_factory
    )
    {
        $this->stream_factory = $stream_factory;

        $this->aggregate_id = $generator->null();
        $this->version = new Integer(0);
        $this->limit = new Integer(1000);
        $this->chunk_size = new Integer(1000);
    }

    public function after(Integer $version)
    {
        $this->version = $version;

        return $this;
    }

    public function ids(Identifier $aggregate_id, Identifier $aggregate_type_id)
    {
        $this->aggregate_id = $aggregate_id;
        $this->aggregate_type_id = $aggregate_type_id;

        return $this;
    }
  
    public function limit(Integer $limit)
    {
        $this->limit = $limit;

        return $this;
    }

    public function chunk(Integer $size)
    {
        $this->chunk_size = $size;
        return $this;
    }

    public function stream()
    {
        return $this->stream_factory->create(
            $this->aggregate_id,
            $this->aggregate_type_id,
            $this->version,
            $this->limit,
            $this->chunk_size
        );
    }
}
