<?php namespace BoundedContext\Sourced\Aggregate;

use BoundedContext\Contracts\Business\Invariant\Factory;
use BoundedContext\Contracts\Sourced\Aggregate\TypeId\Factory as TypeIdFactory;
use BoundedContext\Contracts\Command\Command;
use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Sourced\Aggregate\State\State;
use BoundedContext\Command\Handling;
use BoundedContext\Collection\Collection;

abstract class AbstractAggregate
{
    use Handling;

    protected $state;
    protected $changes;

    protected $type_id;
    protected $check;

    public function __construct(TypeIdFactory $type_id_factory, Factory $invariant_factory, State $state)
    {
        $this->state = $state;
        $this->changes = new Collection();
        
        $this->type_id = $type_id_factory->aggregate_class(get_called_class());
        $this->check = new Check($invariant_factory, $state);
    }

    public function handle(Command $command)
    {
        $this->mutate($command);
    }

    protected function apply(Event $event)
    {
        $event->set_aggregate_type_id($this->type_id);
        $this->state->apply($event);
        $this->changes->append($event);
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
