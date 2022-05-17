<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomType extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'no_guests',
        'no_beds'
    ];

    public function room(){
        return $this->belongsTo(Room::class,'type','type');
        }
}
