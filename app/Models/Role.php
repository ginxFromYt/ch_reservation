<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;



    // again relationship nyo masisira din pag di nyo inalagaan
    public function users()
    {
        return $this->belongsToMany(User::class, 'role_users');
    }


}
