<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Transaction extends Model
{
    use HasFactory;

    const WITHDRAW_PENDING = 0;
    const WITHDRAW_SUCCESS = 1;
    const WITHDRAW_CANCELLED = 2;

    const TYPE_WITHDRAW = "Withdraw";
    const TYPE_DEPOSIT = "Deposited";
    const TYPE_EXPENSES = "Expenses";

    /**
     * Get user total earning.
     *
     * @return float
     */
    public function getUserTotalEarnings()
    {
        $referral_amount = DB::table('setting')->first()->referral_amount;
        $activeUsers = User::where('referrer_id', Auth::user()->id)
                            ->where('active', User::USER_STATUS_ACTIVE)
                            ->get();
        $totalEarnings = count($activeUsers) * $referral_amount;
        return $totalEarnings;
    }

    /**
     * Get user balance.
     *
     * @return float
     */
    public function getUserBalance()
    {
        $totalEarnings = $this->getUserTotalEarnings();
        $expenses = DB::table('transactions')
                        ->where('transaction_type', $this::TYPE_EXPENSES)
                        ->max('amount');
        $expenses_amount = $expenses != null ? $expenses : 0;
        $balance = $totalEarnings - $expenses_amount;
        return $balance;
    }
}
