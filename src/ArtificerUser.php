<?php

namespace Mascame\Artificer;

use Illuminate\Foundation\Auth\User as Authenticatable;

class ArtificerUser extends Authenticatable
{

    protected $table = 'artificer_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
