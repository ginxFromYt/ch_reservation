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
        'reservation_id',
        'bride_name',
        'groom_name' ,
        'groom_birth_date',
        'groom_age',
        'groom_birth_place',
        'groom_address',
        'groom_father_name',
        'groom_mother_name',
        'groom_job',
        'groom_religion',
        'bride_birth_date',
        'bride_age',
        'bride_birth_place',
        'bride_address',
        'bride_father_name' ,
        'bride_mother_name' ,
        'bride_job',
        'bride_religion' ,
        'sponsor_ninong1' ,
        'sponsor_ninang1' ,
        'sponsor_ninong2' ,
        'sponsor_ninang2' ,
        'marriage_file' ,
    ];

}
