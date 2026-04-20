<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'approval'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // karena kolom database kamu beda
    const CREATED_AT = 'create_at';
    const UPDATED_AT = 'update_at';
}