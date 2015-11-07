<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Connections model
 */
class Connection extends Model
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
 
    /**
     * To point
     *
     * @return Relation
     */
    public function to()
    {
        return $this->belongsTo('App\Point', 'to_id');
    }

    /**
     * From point
     *
     * @return Relation
     */
    public function from()
    {
        return $this->belongsTo('App\Point', 'from_id');
    }
}
