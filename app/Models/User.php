<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama_user',
        'email_user',
        'password_user',
    ];

    protected $hidden = [
        'password_user',
        'remember_token',
    ];

    public function getAuthPassword()
    {
        return $this->password_user;
    }
}
