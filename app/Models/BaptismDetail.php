<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BaptismDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'reservation_id',
        'child_name',
        'child_bday',
        'mother_name',
        'mother_bday',
        'father_name',
        'father_bday',
        'sponsor_female',
        'sponsor_male',
    ];
}
