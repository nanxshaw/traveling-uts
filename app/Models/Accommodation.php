<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'location',
    ];

    // Relasi ke Tourist
    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }

    // Relasi ke AccommodationOrder
    public function orders()
    {
        return $this->hasMany(AccommodationOrder::class);
    }
}
