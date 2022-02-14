<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Screenshot extends Model
{
    use HasFactory;

    const SCREENSHOT_PAID = 1;
    const SCREENSHOT_PENDING = 0;
}
