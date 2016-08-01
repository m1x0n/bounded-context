<?php namespace BoundedContext\Player;

use BoundedContext\Contracts\Event\Event;
use BoundedContext\Contracts\Event\Snapshot\Snapshot;

trait Playing
{
    private function from_camel_case($input)
    {
        preg_match_all('!([A-Z][A-Z0-9]*(?=$|[A-Z][a-z0-9])|[A-Za-z][a-z0-9]+)!', $input, $matches);
        $ret = $matches[0];
        foreach ($ret as &$match) {
            $match = $match == strtoupper($match) ? strtolower($match) : lcfirst($match);
        }
        return implode('_', $ret);
    }

    protected function get_handler_name(Event $event)
    {
        $namespace_items = $this->remove_unneccessary_path_items(explode("\\", get_class($event)));
        $namespace_path_items = array_map([$this, 'from_camel_case'], $namespace_items);

        return 'when_'.implode("_", $namespace_path_items);
    }
    
    private function remove_unneccessary_path_items($namespace_path_items)
    {
        unset($namespace_path_items[0]);
        unset($namespace_path_items[3]);
        unset($namespace_path_items[5]);
        return array_values($namespace_path_items);
    }

    protected function can_apply(Event $event)
    {
        $function = $this->get_handler_name($event);
        return method_exists($this, $function);
    }

    protected function mutate(Event $event, Snapshot $snapshot)
    {
        $handler = $this->get_handler_name($event);

        $this->$handler($event, $snapshot);
    }
}
