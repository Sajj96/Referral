<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoUsers extends Model
{
    use HasFactory;

    protected $primaryKey = ['video_id', 'user_id'];
    protected $incrementing = false;
}
