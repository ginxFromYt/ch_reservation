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
        'child_birthcert',
        'child_birthplace',
        'mother_name',
        'mother_bday',
        'mother_birthplace',
        'mother_religion',
        'father_name',
        'father_bday',
        'father_birthplace',
        'father_religion',
        'address',
        'contact_number',
        'sponsor_female',
        'sponsor_male',
    ];
}
