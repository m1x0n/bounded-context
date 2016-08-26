<?php namespace BoundedContext\Event;

use EventSourced\ValueObject\ValueObject\Type\AbstractSingleValue;
use EventSourced\ValueObject\Contracts\ValueObject\Identifier;

class AggregateType extends AbstractSingleValue implements Identifier
{
    protected function validator()
    {
        return parent::validator()->alnum("_.")->noWhitespace()->lowercase();
    }

    public static function from_class_string($class)
    {
        $parts = explode("\\", strtolower($class));
        unset($parts[0]);
        unset($parts[3]);
        unset($parts[5]);
        $parts = array_values($parts);
        return new AggregateType(implode(".", $parts));
    }

    public function to_aggregate_class()
    {
        $parts = explode(".", $this->value());
        $class_path = [
            "Domain",
            ucfirst($parts[0]),
            ucfirst($parts[1]),
            "Aggregate",
            ucfirst($parts[2])
        ];
        return implode("\\", $class_path);
    }

    public function is_null()
    {
        return false;
    }
}