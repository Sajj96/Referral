<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    use HasFactory;

    const WITHDRAW_PENDING = 0;
    const WITHDRAW_SUCCESS = 1;
    const WITHDRAW_CANCELLED = 2;
}
