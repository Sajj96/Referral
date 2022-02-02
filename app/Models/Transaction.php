<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    const WITHDRAW_PENDING = 0;
    const WITHDRAW_SUCCESS = 1;
    const WITHDRAW_CANCELLED = 2;

    const TYPE_WITHDRAW = "Withdraw";
    const TYPE_DEPOSIT = "Deposited";
    const TYPE_PAY_FOR_CLIENT = "Paid For Client";
}
