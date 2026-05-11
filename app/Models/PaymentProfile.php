<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProfile extends Model
{
    protected $fillable = [
        'slug',
        'platform',
        'nomor',
        'nama',
        'nominal',
        'qr_image',
    ];
}
