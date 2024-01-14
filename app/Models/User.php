<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    use HasFactory;
    /**
     * 複数代入不可能な属性
     */
     protected $fillable = [
         'name',
         'email',
         'password',
         ];

     protected $hidden = [
        'password',
        'remember_token',
         ];

     protected $casts = [
         'email_verified_at' => 'datetime',
         ];
}
