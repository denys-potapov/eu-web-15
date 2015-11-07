<?php

namespace App\Graph;

/**
 *  Path class
 */
class Path
{
    public $lengh;

    public $vertexes = array();

    public $distances = array();

    public function add($vertex, $distance)
    {
        array_unshift($this->vertexes, $vertex);
        array_unshift($this->distances, $distance);
    }
}
