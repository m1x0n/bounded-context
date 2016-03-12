<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Command\Command;

use BoundedContext\Contracts\Event\Factory as EventFactory;
use BoundedContext\Contracts\Sourced\Log\Log as EventLog;

use BoundedContext\Contracts\Sourced\Aggregate\Aggregate;
use BoundedContext\Contracts\Sourced\Aggregate\Factory as AggregateFactory;
use BoundedContext\Contracts\Sourced\Aggregate\TypeId\Factory as AggregateTypeIdFactory; 
use BoundedContext\Contracts\Sourced\Aggregate\Stream\Builder as AggregateStreamBuilder;

use BoundedContext\Contracts\Sourced\Aggregate\State\Factory as StateFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Factory as StateSnapshotFactory;
use BoundedContext\Contracts\Sourced\Aggregate\State\Snapshot\Repository as StateSnapshotRepository;

class Repository implements \BoundedContext\Contracts\Sourced\Aggregate\Repository
{
    private $state_snapshot_repository;
    private $state_snapshot_factory;
    private $state_factory;

    private $aggregate_factory;
    private $aggregate_type_id_factory;
    private $aggregate_stream_builder;

    private $event_factory;
    private $event_log;

    public function __construct(
        StateSnapshotRepository $state_snapshot_repository,
        StateSnapshotFactory $state_snapshot_factory,
        StateFactory $state_factory,
        AggregateFactory $aggregate_factory,
        AggregateTypeIdFactory $aggregate_type_id_factory,
        AggregateStreamBuilder $aggregate_stream_builder,
        EventFactory $event_factory,
        EventLog $event_log
    )
    {
        $this->state_snapshot_repository = $state_snapshot_repository;
        $this->state_snapshot_factory = $state_snapshot_factory;
        $this->state_factory = $state_factory;

        $this->aggregate_factory = $aggregate_factory;
        $this->aggregate_type_id_factory = $aggregate_type_id_factory;

        $this->aggregate_stream_builder = $aggregate_stream_builder;

        $this->event_factory = $event_factory;
        $this->event_log = $event_log;
    }

    public function by(Command $command)
    {
        $state = $this->state_factory
            ->with($command)
            ->snapshot( $this->snapshot($command) );

        $event_stream = $this->aggregate_stream_builder
            ->ids($state->aggregate_id(), $state->aggregate_type_id())
            ->after($state->version())
            ->stream();

        foreach($event_stream as $event)
        {
            $state->apply(
                $this->event_factory->snapshot($event)
            );
        }

        return $this->aggregate_factory->state($state);
    }
    
    private function snapshot(Command $command)
    {
        return $this->state_snapshot_repository->ids(
            $command->id(),
            $this->aggregate_type_id_factory->command($command)
        );
    }

    public function save(Aggregate $aggregate)
    {
        $this->state_snapshot_repository->save(
            $this->state_snapshot_factory->state(
                $aggregate->state()
            )
        );

        $this->event_log->append_collection(
            $aggregate->changes()
        );

        $aggregate->flush();
    }
}
