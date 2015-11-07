<?php

namespace App\Graph;

/**
 * Graph class
 */
class Graph
{
    const INFINITY = PHP_INT_MAX;

    protected $size;

    protected $vertexes = array();

    protected $edges = array();

    public function __construct($size)
    {
        $this->size = $size;
        $this->edges = array_fill(0, $size, array());
    }

    public function addEdge($start, $end, $distance)
    {
        $this->edges[$start][$end] = $distance;
        $this->edges[$end][$start] = $distance;
    }

    protected function findMin($distances, $unvisited)
    {
        $minDistance = self::INFINITY;
        $minVertex = array_keys($unvisited)[0];

        foreach (array_keys($unvisited) as $vertex) {
            if ($distances[$vertex] < $minDistance) {
                $minDistance = $distances[$vertex];
                $minVertex = $vertex;
            }
        }

        return $minVertex;
    }

    public function findPath($start, $end)
    {
        $distances = array_fill(0, $this->size, self::INFINITY);
        $unvisited = array_fill(0, $this->size, true);
        $previous = array_fill(0, $this->size, null);

        $distances[$start] = 0;
        while ($unvisited) {
            $vertex = $this->findMin($distances, $unvisited);
            if ($vertex == $end) {
                break;
            }
            unset($unvisited[$vertex]);

            foreach ($this->edges[$vertex] as $neighbor => $distance) {
                $alternative = $distances[$vertex] + $distance;

                if ($alternative < $distances[$neighbor]) {
                    $distances[$neighbor] = $alternative;
                    $previous[$neighbor] = $vertex;
                }
            }
        }
 
        if ($distances[$vertex] == self::INFINITY) {
            throw new \Exception("Path not found");
        }
        
        // Build path

        $path = new Path();
        while ($previous[$vertex] !== null) {
            $path->add($vertex, $distances[$vertex]);
            $vertex = $previous[$vertex];
        }
        $path->add($vertex, $distances[$vertex]);
        
        return $path;
    }
}
