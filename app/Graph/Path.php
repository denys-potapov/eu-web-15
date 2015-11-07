<?php

namespace App\Graph;

/**
 *  Path class
 */
class Path
{
    /**
     * Array of path vertexes
     *
     * @var array
     */
    public $vertexes = array();

    /**
     * Array of path distances
     *
     * @var array
     */
    public $distances = array();

    /**
     * Add path part
     *
     * @param integer $vertex
     * @param integer $distance
     */
    public function add($vertex, $distance)
    {
        array_unshift($this->vertexes, $vertex);
        array_unshift($this->distances, $distance);
    }
}
