<?php

namespace App;

use App\Concerns\UuidAsPrimaryKey;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, UuidAsPrimaryKey;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'string',
        'last_login' => 'datetime',
        'allowed_backstage' => 'boolean',
        'email_verified_at' => 'datetime',
    ];

    /**
     * Is this user allowed backstage?
     *
     * @return bool
     */
    public function isAllowedBackstage()
    {
        return $this->allowed_backstage;
    }
}
