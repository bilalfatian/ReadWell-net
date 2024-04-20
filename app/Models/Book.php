<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Book extends Authenticatable
{
    protected $table = 'books'; 
    use HasFactory, Notifiable;
    use \Illuminate\Auth\Authenticatable;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
