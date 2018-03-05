<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name', 'email', 'password', 'profile_picture', 'gender', 'dob', 'address', 
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin() 
    {
        if($this->role == 2) // 2=admin
            return true; 
        
        return false;
    }
}
