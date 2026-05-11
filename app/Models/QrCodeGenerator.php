<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class QrCodeGenerator extends Model
{
    protected $fillable = [
        'user_id',
        'qr_type',
        'qr_content',
        'qr_image',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
