<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReceptionistLog extends Model
{
    use HasFactory;

    protected $table = 'receptionist_logs';

    protected $fillable = [
        'user_id',
        'reservation_id',
        'action',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class, 'reservation_id', 'reservation_id');
    }

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id', 'rooms_id');
    }

    public function receipt()
    {
        return $this->hasOne(Receipt::class, 'reservation_id', 'reservation_id');
    }
}
