<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'event_id',
        'bride_name',
        'groom_name',
        'marriage_file',
        'wedding_participants',
        'wedding_notes',
    ];
}
