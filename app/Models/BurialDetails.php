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
        'date_birth',
        'date_death',
        'time_death',
        'age',
        'civil_status',
        'cause_of_death',
        'place_of_burial',
        'date_burial',
        'time_burial',
        'cert_death',
        'contact_person',
        'relationship',
        'contact_number',
    ];
}
