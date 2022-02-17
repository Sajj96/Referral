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

    const REGISTRATION_FEE = 13000;

    const TYPE_WITHDRAW = "Withdraw";
    const TYPE_DEPOSIT = "Deposited";
    const TYPE_PAY_FOR_DOWNLINE = "pay_for_downline";

    /**
     * Get user total earning.
     *
     * @return float
     */
    public function getUserTotalEarnings()
    {
        $referral_amount_level_1 = 6000;
        $referral_amount_level_2 = 3000;
        $referral_amount_level_3 = 1000;
        $user = Auth::user();

        $level_1 = DB::table('users','t1')
                    ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                    ->where(DB::raw('t1.id'), DB::raw($user->id))
                    ->where(DB::raw('t1.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->where(DB::raw('t2.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->get();

        $level_2 = DB::table('users','t1')
                    ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                    ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                    ->where(DB::raw('t1.id'), DB::raw($user->id))
                    ->where(DB::raw('t1.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->where(DB::raw('t2.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->where(DB::raw('t3.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->get();

        $level_3 = DB::table('users','t1')
                    ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                    ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                    ->leftJoin('users as t4', 't4.referrer_id','=','t3.id')
                    ->where(DB::raw('t1.id'), DB::raw($user->id))
                    ->where(DB::raw('t1.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->where(DB::raw('t2.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->where(DB::raw('t3.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->where(DB::raw('t4.active'), DB::raw(User::USER_STATUS_ACTIVE))
                    ->get();

        $count_level_1 = count($level_1) ?? 0;
        $count_level_2 = count($level_2) ?? 0;
        $count_level_3 = count($level_3) ?? 0;
        $total_level_1 = $count_level_1 * $referral_amount_level_1;
        $total_level_2 = $count_level_2 * $referral_amount_level_2;
        $total_level_3 = $count_level_3 * $referral_amount_level_3;
        $totalEarnings = $total_level_1 + $total_level_2 + $total_level_3;
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

        $withdrawn = $this->getUserWithdrawnAmount();

        $payment_for_downline = $this->getUserPaymentForDownline();

        $withdrawn_amount = $withdrawn ?? 0;
        $payment_amount = $payment_for_downline ?? 0;

        $balance = $totalEarnings - $withdrawn_amount - $payment_amount;
        return $balance;
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
     * Get user payment for downline amount.
     *
     * @return float
     */
    public function getUserPaymentForDownline()
    {
        $payment = DB::table('transactions')
                        ->where('transaction_type', self::TYPE_PAY_FOR_DOWNLINE)
                        ->where('user_id', Auth::user()->id)
                        ->sum('amount');
        $payment_amount = $payment ?? 0;
        return $payment_amount;
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

    /**
     * Get whatsapp earnings.
     *
     * @return float
     */
    public function getWhatsAppEarnings()
    {
        $earning = DB::table('revenues')
                        ->where('type', Revenue::TYPE_WHATSAPP)
                        ->where('user_id', Auth::user()->id)
                        ->sum('amount');
        $earning_amount = $earning ?? 0;
        return $earning_amount;
    }

    /**
     * Get trivia question earnings.
     *
     * @return float
     */
    public function getQuestionsEarnings()
    {
        $earning = DB::table('revenues')
                        ->where('type', Revenue::TYPE_TRIVIA_QUESTION)
                        ->sum('amount');
        $earning_amount = $earning ?? 0;
        return $earning_amount;
    }

    /**
     * Get video earnings.
     *
     * @return float
     */
    public function getVideoEarnings()
    {
        $earning = DB::table('revenues')
                        ->where('type', Revenue::TYPE_VIDEO)
                        ->sum('amount');
        $earning_amount = $earning ?? 0;
        return $earning_amount;
    }

    /**
     * Get video earnings.
     *
     * @return float
     */
    public function getProfit()
    {
        $totalBalance = $this->getUserTotalEarnings();
        $whatsAppEarnings = $this->getWhatsAppEarnings();
        $questionsEarning = $this->getQuestionsEarnings();
        $videoEarnings = $this->getVideoEarnings();

        $profit_amount = $totalBalance + $whatsAppEarnings + $questionsEarning + $videoEarnings;
        return $profit_amount;
    }
}
