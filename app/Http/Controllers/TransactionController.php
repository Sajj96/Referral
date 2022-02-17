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
        $transactions = Transaction::all();
        $withdraw_requests = Transaction::where('transaction_type',Transaction::TYPE_WITHDRAW)
                                         ->where('status',Transaction::WITHDRAW_PENDING)
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
        $transactions = new Transaction();
        $balance = $transactions->getUserBalance();

        return view('transaction.withdraw', compact('setting','balance'));
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
            $balance = $transactions->getUserBalance();

            if($request->amount > $balance) {
                return redirect()->route('withdraw')->with('error','You don\'t have enough balance to withdraw '. $request->amount);
            }

            $withdraw = new Transaction;
            $withdraw->balance = $request->balance;
            $withdraw->user_id = Auth::user()->id;
            $withdraw->phone = $request->phone;
            $withdraw->amount = $request->amount;
            $withdraw->amount_deposit = $request->deposit;
            $withdraw->fee = $request->fee;
            $withdraw->transaction_type = Transaction::TYPE_WITHDRAW;
            $withdraw->status = Transaction::WITHDRAW_PENDING;

            if($withdraw->save()) {
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
            $withdraw->status = Transaction::WITHDRAW_SUCCESS;
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
            $withdraw->status = Transaction::WITHDRAW_CANCELLED;
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
            $balance = $transactions->getUserBalance();

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
