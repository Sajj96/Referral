<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class TransactionController extends Controller
{
    /**
     * Show the history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = DB::table('transactions')
                            ->join('users','transactions.user_id','=','users.id')
                            ->select('transactions.*','users.username','users.name')
                            ->get();
        $withdraw_requests = DB::table('transactions')
                                    ->join('users','transactions.user_id','=','users.id')
                                    ->select('transactions.*','users.username','users.name')
                                    ->where('transaction_type',Transaction::TYPE_WITHDRAW)
                                    ->where('status',Transaction::TRANSACTION_PENDING)
                                    ->get();
        $serial_1 = 1;
        $serial_2 = 1;
        return view('transaction.admin_history', compact('transactions','withdraw_requests','serial_1','serial_2'));
    }

    /**
     * Show the history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function userTransactions()
    {
        $transactions = Transaction::where('user_id', Auth::user()->id)->get();
        $serial = 1;
        return view('transaction.history', compact('transactions','serial'));
    }

    /**
     * Show the withdraw page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $setting = DB::table('setting')->first();
        $id = Auth::user()->id;
        $transactions = new Transaction();
        $balance = $transactions->getUserBalance($id);
        $trivia = $transactions->getQuestionsEarnings($id);
        $video = $transactions->getVideoEarnings($id);
        $whatsapp = $transactions->getWhatsAppEarnings($id);

        return view('transaction.withdraw', compact('setting','balance','trivia','video','whatsapp'));
    }

    /**
     * Show the withdraw page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInactiveDownlines()
    {
        $downlines = User::where('referrer_id', Auth::user()->id)->where('active', 0)->get();
        $serial = 1;
        return view('transaction.pay_for_client', compact('downlines', 'serial'));
    }

    /**
     * Show the get paid page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPaid(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'balance' => 'required|string',
            'phone'   => 'required',
            'amount'  => 'required|numeric'
        ]);

        if($validator->fails()) {
            return redirect()->route('withdraw')->with('error','Only valid details are required!');
        }

        try {

            $transactions = new Transaction();
            $id = Auth::user()->id;

            if($request->balance == "main") {
                $balance = $transactions->getUserBalance($id);
                $type = Transaction::TYPE_WITHDRAW;
            } else if($request->balance == "trivia") {
                $balance = $transactions->getQuestionsEarnings($id);
                $type = Transaction::TYPE_QUESTIONS;
            } else if($request->balance == "video") {
                $balance = $transactions->getVideoEarnings($id);
                $type = Transaction::TYPE_VIDEO;
            } else {
                $balance = $transactions->getWhatsAppEarnings($id);
                $type = Transaction::TYPE_WHATSAPP;
            }

            if($request->amount > $balance) {
                return redirect()->route('withdraw')->with('error','You don\'t have enough balance to withdraw '. $request->amount);
            }

            $transaction = new Transaction;
            $transaction->balance = $request->balance;
            $transaction->user_id = Auth::user()->id;
            $transaction->phone = $request->phone;
            $transaction->amount = $request->amount;
            $transaction->amount_deposit = $request->deposit;
            $transaction->fee = $request->fee;
            $transaction->transaction_type = $type;
            $transaction->status = Transaction::TRANSACTION_PENDING;

            if($transaction->save()) {
                return redirect()->route('withdraw')->with('success','You have successfully withdrawn TZS '.$request->amount.'. Please wait for confirmation!.');
            }
        } catch (\Exception $e) {
            return redirect()->route('withdraw')->with('error','Something went wrong while withdrawing!');
        }
    }

    public function settings()
    {
        $settings = DB::table('setting')->first();
        return view('setting', compact('settings'));
    }

    public function saveSettings(Request $request)
    {
        try {

            if($request->minimum > $request->maximum) {
                return redirect()->route('setting')->with('error','Minimum withdraw must be less than Maximum withdraw');
            }

            $setting = DB::table('setting')->updateOrInsert(
                ['id' => 1],
                [
                'referral_amount' => $request->referral_amount,
                'minimum' => $request->minimum,
                'maximum'   => $request->maximum,
                'deducted'   => $request->deducted,
                'created_at' => (new Carbon('now'))->format('Y-m-d H:m:s'),
                'updated_at' => (new Carbon('now'))->format('Y-m-d H:m:s')
            ]);
            if($setting){
                return redirect()->route('setting')->with('success','Transaction setting are saved');
            }
        } catch (\Exception $e) {
            return redirect()->route('setting')->with('error','Something went wrong while modifying settings!');
        }
    }

    public function acceptWithdraw(Request $request)
    {
        try {
            $withdraw = Transaction::find($request->withdraw_id);
            $withdraw->status = Transaction::TRANSACTION_SUCCESS;
            if($withdraw->save()){
                return redirect()->route('transaction')->with('success','Withdraw request accepted!');
            }
        } catch (\Exception $e) {
            $withdraw = Transaction::find($request->id);
            return redirect()->route('transaction')->with('error',$e->getMessage());
        }
    }

    public function declineWithdraw(Request $request)
    {
        try {
            $withdraw = Transaction::find($request->id);
            $withdraw->status = Transaction::TRANSACTION_CANCELLED;
            if($withdraw->save()){
                return redirect()->route('transaction')->with('success','Withdraw request declined!');
            }
        } catch (\Exception $e) {
            return redirect()->route('transaction')->with('error','Something went wrong while cancelling withdraw request!');
        }
    }

    public function payForDownline(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('pay_for_downline')->with('error','Only valid details are required!');
        }

        try {

            $transactions = new Transaction();
            $id = Auth::user()->id;
            $balance = $transactions->getUserBalance($id);

            if(Transaction::REGISTRATION_FEE > $balance) {
                return redirect()->route('pay_for_downline')->with('error','You don\'t have enough balance to make payment');
            }

            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password')])) {
                $user = User::where('id',$request->id)->first();
                $user->active = User::USER_STATUS_ACTIVE;
                if($user->save()) {
                    $payment = new Transaction;
                    $payment->balance = "main";
                    $payment->user_id = Auth::user()->id;
                    $payment->phone = Auth::user()->phone;
                    $payment->amount = Transaction::REGISTRATION_FEE;
                    $payment->amount_deposit = 0;
                    $payment->fee = 0;
                    $payment->transaction_type = Transaction::TYPE_PAY_FOR_DOWNLINE;
                    $payment->status = 1;
                    if($payment->save()) {
                        return redirect()->route('pay_for_downline')->with('success','You successfully paid for your downline!');
                    }
                }
            } 

            return redirect()->route('pay_for_downline')->with('error','Incorrect password!');
        } catch (\Exception $e) {
            return redirect()->route('pay_for_downline')->with('error','Payment was not successfully!');
        }
    }
}
