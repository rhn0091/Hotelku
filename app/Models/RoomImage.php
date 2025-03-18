<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomImage extends Model
{
    use HasFactory;

    protected $table = 'room_images';
    protected $primaryKey = 'id'; // Menetapkan 'id' sebagai primary key
    public $incrementing = true; // ID akan bertambah secara otomatis
    protected $keyType = 'int'; // ID bertipe integer

    protected $fillable = [
        'id',
        'rooms_id',
        'image_path',
    ];

    public function room()
    {
        return $this->belongsTo(Room::class, 'rooms_id', 'rooms_id');
    }
}
