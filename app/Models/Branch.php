<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branchNo',
        'city',
        'country',
        'location',
        'phone'

    ];

    public function room(){
        return $this->belongsTo(Room::class,'branchNo','branchNo');

    }
}
