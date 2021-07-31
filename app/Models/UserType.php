<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'users_types';

    protected $fillable = [
        'name',
    ];

    protected $hidden = ['created_at', 'updated_at'];
}