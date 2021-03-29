<?php

namespace App\Models;

use Illuminate\Auth\Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Spatie\Permission\Traits\HasRoles;
use EloquentFilter\Filterable;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use HasRoles, 
        HasApiTokens, 
        Authenticatable, 
        Authorizable, 
        Filterable;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = ["password_confirmation"];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = ['full_name'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * Find the user instance for the given identifier using either username or email.
     * @param  string  $identifier
     * @return \App\Models\User
     */
    public function findForPassport($loginData) {
        // return $this->orWhere('email', $identifier)->orWhere('username', $identifier)->first();
        // return $this->where('id', $identifier)->first();

        return $this->where([
                ['organization_id', '=', $loginData["organization_id"]],
                ['branch_id', '=', $loginData["branch_id"]],
                ['email', '=', $loginData["identifier"]]
            ])->orWhere([
                ['organization_id', '=', $loginData["organization_id"]],
                ['branch_id', '=', $loginData["branch_id"]],
                ['username', '=', $loginData["identifier"]]
            ])->first();
    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    public function getFirstNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's last name.
     *
     * @param  string  $value
     * @return string
     */
    public function getLastNameAttribute($value)
    {
        return ucfirst($value);
    }

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get the user's avatar.
     */
    public function avatar()
    {
        return $this->morphOne(File::class, 'fileable');
    }

    /**
     * Get all the groups of a user.
     */
    public function groups()
    {
        return $this->belongsToMany('App\Models\Group');
    }

    /**
     * Get the organization a user belongs to.
     */
    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
}
