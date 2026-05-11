<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrCodeGenerator extends Model
{
    protected $fillable = [
        'qr_type',
        'qr_content',
        'qr_image',
    ];
}
