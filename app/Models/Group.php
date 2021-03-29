<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the organization a group belongs to.
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
