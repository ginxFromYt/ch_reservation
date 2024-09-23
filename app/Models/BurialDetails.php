<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BurialDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'reservation_id',
        'name_deceased',
        'date_death',
        'time_death',
        'contact_person',
        'relationship',
        'contact_number',
        'email',
    ];
}
