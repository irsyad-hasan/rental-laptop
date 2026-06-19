<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = [

        'customer_id',

        'laptop_id',

        'tanggal_rental',

        'tanggal_kembali',

        'durasi',

        'total_biaya',

        'denda',

        'status'

    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function laptop()
    {
        return $this->belongsTo(Laptop::class)
            ->withTrashed();
    }
}