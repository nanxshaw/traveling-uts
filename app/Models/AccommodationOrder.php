<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccommodationOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'accommodation_id',
        'customer_name',
        'check_in',
        'check_out',
    ];

    // Relasi ke Accommodation
    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }
}
