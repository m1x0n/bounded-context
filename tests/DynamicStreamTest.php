<?php

use BoundedContext\Contracts\Sourced\Stream\Stream;
use BoundedContext\Sourced\Stream\UpgradedStream;

class DynamicStreamTest extends PHPUnit_Framework_TestCase
{
    public function test_streaming_through_an_upgrader()
    {
        $stream = $this->fakeStream();
        $upgrader = $this->fakeUpgrader();

        $upgraded_stream = new UpgradedStream($stream, $upgrader);

        $items = [];
        foreach ($upgraded_stream as $item) {
            $items[] = $item;
        }

        $this->assertEquals([1,2,3,4,5], $items);
    }

    private function fakeStream()
    {
        return new Class() implements Stream {

            private $items = ['a','b','c'];

            public function current()
            {
                return current($this->items);
            }

            public function next()
            {
                return next($this->items);
            }

            public function key()
            {
                return key($this->items);
            }

            public function valid()
            {
                // TODO: Implement valid() method.
            }

            public function rewind()
            {
                $this->rewind($this->items);
            }
        };
    }

    private function fakeUpgrader()
    {
        return new Class() {
            public function upgrade($item)
            {
                if ($item == 'a') {
                    return [1,2];
                }
                if ($item == 'c') {
                    return [3,4,5];
                }
                return [];
            }
        };
    }
}

