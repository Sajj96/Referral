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
        $referral_amount = DB::table('setting')->first()->referral_amount ?? 0;
        $activeUsers = User::where('referrer_id', Auth::user()->id)
                            ->where('active', User::USER_STATUS_ACTIVE)
                            ->get();
        $countActiveUser = count($activeUsers) ?? 0;
        $totalEarnings = $countActiveUser * $referral_amount;
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
                        ->where('transaction_type', self::TYPE_EXPENSES)
                        ->where('user_id', Auth::user()->id)
                        ->max('amount');
        $withdrawn = $this->getUserWithdrawnAmount();

        $expenses_amount = $expenses ?? 0;
        $withdrawn_amount = $withdrawn ?? 0;
        $balance = $totalEarnings - ($withdrawn_amount - $expenses_amount);
        return $balance;
    }

    /**
     * Get user expenses.
     *
     * @return float
     */
    public function getUserExpenses()
    {
        $expenses = DB::table('transactions')
                        ->where('transaction_type', self::TYPE_EXPENSES)
                        ->where('user_id', Auth::user()->id)
                        ->sum('amount');
        $expenses_amount = $expenses ?? 0;
        return $expenses_amount;
    }

    /**
     * Get user withdrawn amount.
     *
     * @return float
     */
    public function getUserWithdrawnAmount()
    {
        $withdrawn = DB::table('transactions')
                        ->where('transaction_type', self::TYPE_WITHDRAW)
                        ->where('user_id', Auth::user()->id)
                        ->sum('amount');
        $withdrawn_amount = $withdrawn ?? 0;
        return $withdrawn_amount;
    }

    /**
     * Get user system earnings.
     *
     * @return float
     */
    public function getSystemEarnings()
    {
        $earning = DB::table('transactions')
                        ->sum('fee');
        $earning_amount = $earning ?? 0;
        return $earning_amount;
    }

    /**
     * Get user system earnings.
     *
     * @return float
     */
    public function getWithdrawRequests()
    {
        $withdraw_request = DB::table('transactions')
                        ->where('transaction_type', self::TYPE_WITHDRAW)
                        ->where('status', self::WITHDRAW_PENDING)
                        ->get();
        $numRequest = count($withdraw_request) ?? 0;
        return $numRequest;
    }
}
