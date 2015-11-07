<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Points model
 */
class Point extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Protect id from assigment
     *
     * @var array
     */
    protected $guarded = ['id'];

}
