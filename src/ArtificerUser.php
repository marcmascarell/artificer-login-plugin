<?php

namespace Mascame\Artificer;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Mascame\Artificer\Notifications\ResetPassword;
use Illuminate\Foundation\Auth\User as Authenticatable;

class ArtificerUser extends Authenticatable
{
    use HasRoles;
    use Notifiable;

    protected $table = 'artificer_users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
