<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Business\Invariant\Factory;
use BoundedContext\Contracts\Sourced\Aggregate\TypeId\Factory as TypeIdFactory;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Generator;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Command\Handling;
use BoundedContext\Collection\Collection;
use BoundedContext\Event\Event;

abstract class AbstractAggregate
{
    use Handling;

    protected $current_command;
    protected $state;
    protected $changes;

    protected $type_id;
    protected $check;
    protected $id_generator;

    public function __construct(
        TypeIdFactory $type_id_factory, 
        Factory $invariant_factory, 
        Generator\Identifier $id_generator,
        State $state
    )
    {
        $this->state = $state;
        $this->changes = new Collection();
        
        $this->type_id = $type_id_factory->aggregate_class(get_called_class());
        $this->check = new Check($invariant_factory, $state);
        $this->id_generator = $id_generator;
    }

    public function handle(Command $command)
    {
        $this->current_command = $command;
        $this->mutate($command);
    }

    protected function apply($event_class, ...$parameters)
    {
        $aggregate_id_and_parameters = array_merge([$this->state()->aggregate_id()], $parameters);
        $domain_event = new $event_class(...$aggregate_id_and_parameters);
        $this->state->apply($domain_event);
        $loggable_event = $this->make_loggable_event($domain_event);
        $this->changes->append($loggable_event);
    }
    
    private function make_loggable_event($domain_event)
    {
        return new Event(
            $this->id_generator->generate(),
            $this->current_command->id(), 
            $this->state->aggregate_type_id(), 
            $this->state->aggregate_id(), 
            $domain_event
        );
    }

    public function state()
    {
        return $this->state;
    }

    public function changes()
    {
        return $this->changes;
    }
    
    public function flush()
    {
        $this->changes = new Collection();
    }
}
