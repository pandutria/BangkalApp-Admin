<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'role',
        'fullname',
        'username',
        'password',
        'image_url'
    ];

    protected $hidden = [
        'password',
    ];

    public function letter_request() {
        return $this->hasMany(LetterRequest::class);
    }
}
