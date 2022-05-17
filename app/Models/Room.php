<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $primaryKey = 'room_id';
    public $incrementing = false;

    protected $fillable = [
        'room_id',
        // 'manufacturer',
        // 'model',
        // 'year',
        'price',
        // 'insurance',
        // 'transmission',
        // 'gas_type',
        // 'fuel_consumption',
        // 'air_conditioning',
        // 'bluetooth',
        'view',
        'TV',
        'refrigerator',
        'status',
        'image',
        'type',
        'branchNo'
    ];

    public function roomType(){
        return $this->hasOne(RoomType::class,'type','type');
    }

    public function roomBranch(){
        return $this->hasOne(Branch::class,'branchNo','branchNo');
    }
    public function roomReservation(){
        return $this->hasMany(Reservation::class,'room_id','room_id');
    }
}
