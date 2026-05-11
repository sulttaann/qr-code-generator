<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentProfile extends Model
{
    protected $fillable = [
        'user_id',
        'slug',
        'platform',
        'nomor',
        'nama',
        'nominal',
        'qr_image',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
