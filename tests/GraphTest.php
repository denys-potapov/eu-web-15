<?php

namespace App\Tests;

class GraphTest extends \PHPUnit_Framework_TestCase
{
    public function testOnePath()
    {
        $graph = new \App\Graph\Graph(2);
        $graph->addEdge(0, 1, 5);

        $path = $graph->findPath(0, 1);
        $this->assertEquals([0, 1], $path->vertexes);
        $this->assertEquals([0, 5], $path->distances);

        $path = $graph->findPath(1, 0);
        $this->assertEquals([1, 0], $path->vertexes);
        $this->assertEquals([0, 5], $path->distances);
    }

    public function testTwoStep()
    {
        $graph = new \App\Graph\Graph(3);
        $graph->addEdge(0, 1, 5);
        $graph->addEdge(1, 2, 5);
        $graph->addEdge(0, 2, 15);

        $path = $graph->findPath(0, 2);
        $this->assertEquals([0, 1, 2], $path->vertexes);
        $this->assertEquals([0, 5, 10], $path->distances);

        $path = $graph->findPath(2, 0);
        $this->assertEquals([2, 1, 0], $path->vertexes);
        $this->assertEquals([0, 5, 10], $path->distances);
    }

    /**
     * @expectedException \Exception
     */
    public function testNoPath()
    {
        $graph = new \App\Graph\Graph(2);
        $graph->findPath(0, 1);
    }
}
