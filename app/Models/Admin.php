<?php

namespace App\Models;

use App\Concerns\HasRoles;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class admin extends User
{
    use HasFactory,Notifiable,HasApiTokens,HasRoles;

    protected $fillable = ['name','email','password','phone_number',
    'super_admin','status'];
}
