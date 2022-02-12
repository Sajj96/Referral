<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WhatsAppStatus extends Model
{
    use HasFactory;

    const VIDEO_PUBLISHED = 1;
    const VIDEO_PENDING = 0;
}
