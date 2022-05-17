<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $primaryKey = 'res_id';
    public $incrementing = false;



    protected $fillable = [
        'res_id',
        'start_date',
        'end_date',
        'total_amount',
        'location',
        // 'dropoff_location',
        'room_id',
        'SSN',
        'user_id',
        'paid'
    ];

    protected $casts = [
        'start_date' => 'datetime:Y-m-d',
        'end_date' => 'datetime:Y-m-d',
    ];

    public function reservation(){
        return $this->belongsTo(Room::class,'room_id','room_id');
    }
}
