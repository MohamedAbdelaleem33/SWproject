<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarType extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'type',
        'no_passengers',
        'no_bags'
    ];

    public function car(){
        return $this->belongsTo(Car::class,'type','type');
        }
}
