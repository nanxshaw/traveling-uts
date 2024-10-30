<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tourist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location',
    ];

    // Definisikan relasi jika ada, misalnya ke Accommodation
    public function accommodations()
    {
        return $this->hasMany(Accommodation::class);
    }
}
