<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Laptop extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'merk',
        'model',
        'spesifikasi',
        'harga_harian',
        'status'
    ];

    public function rentals()
    {
        return $this->hasMany(Rental::class);
    }
}