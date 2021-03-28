<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    
    /**
     * Table name
     *
     * @var string
     */
    protected $table = 'files';

    /**
     * Get the parent fileable model.
     */
    public function fileable()
    {
        return $this->morphTo();
    }
}
