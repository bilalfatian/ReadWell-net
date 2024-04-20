<?php

namespace App\Models;

/*
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
//class User extends Model implements Authenticatable
*/

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Contracts\Auth\MustVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    protected $table = 'users';
    use HasFactory, Notifiable;
    use \Illuminate\Auth\Authenticatable;

    protected $fillable = [
        'name',
        'email',
        'description',
        'profile_picture',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function books(): HasMany
    {
        return $this->hasMany(Book::class);
    }

    public function isAdmin()
    {
        return $this->user_role === 'admin';
    }
}