<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins'; // Nama tabel yang sesuai
    protected $fillable = ['name_admin', 'email', 'password'];
    protected $hidden = ['password'];
}
