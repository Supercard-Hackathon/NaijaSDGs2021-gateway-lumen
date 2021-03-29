<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\File;

class Organization extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Get the users of an organization.
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }

    /**
     * Accessor to get the headquarter of an organization.
     */
    public function getHeadquarterAttribute()
    {
        return Branch::find($this->hq_branch_id);
    }

    /**
     * Get the organization's logo.
     */
    public function logo()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * Get the groups of an organization.
     */
    public function groups()
    {
        return $this->hasMany('App\Models\Group');
    }
}
