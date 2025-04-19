<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomFacility extends Model
{
    use HasFactory;

    protected $table = 'room_facilities'; // Nama tabel

    protected $primaryKey = 'id'; // Primary Key

    public $incrementing = true; // Auto Increment ID

    protected $fillable = [
        'rooms_id',
        'facility_name',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id');
    }
}
