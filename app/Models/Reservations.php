<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'reservation_id',
        'reservation_date',
        'reservation_time',
        'number_of_people',
        'status',
    ];

}
