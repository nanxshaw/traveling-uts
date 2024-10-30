<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TouristOrder extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tourist_id',
        'customer_name',
        'travel_date',
    ];

    public function tourist()
    {
        return $this->belongsTo(Tourist::class);
    }
}
