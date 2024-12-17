<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Events;

class Reservations extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'event_id',
        'reservation_id',
        'reservation_date',
        'reservation_time',
        // 'number_of_people',
        'status',
    ];

      // Relationship with BaptismDetail
      public function baptismDetails()
      {
          return $this->hasOne(BaptismDetail::class, 'reservation_id', 'id');
      }

      // Relationship with BurialDetails
      public function burialDetails()
      {
          return $this->hasOne(BurialDetails::class, 'reservation_id', 'id');
      }

      // Relationship with WeddingDetail
      public function weddingDetails()
      {
          return $this->hasOne(WeddingDetail::class, 'reservation_id', 'id');
      }

      // Relationship with Event
      public function event()
      {
          return $this->belongsTo(Events::class, 'event_id', 'id');
      }

}
