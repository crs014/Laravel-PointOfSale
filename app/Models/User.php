<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = "users";
    protected $guarded = ['id'];
    protected $fillable = ['name', 'email', 'password','role',];
    protected $hidden = ['password', 'remember_token',];
    public $timestamps = true;

    public function roles()
    {
        return $this->hasMany("App\Models\Role");
    }
}
