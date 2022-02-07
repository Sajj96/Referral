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
        $serial = 1;
        return view('transaction.history', compact('transactions','serial'));
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
        return view('transaction.withdraw', compact('setting'));
    }

    /**
     * Show the withdraw page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showInactiveClients()
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
            $withdraw = new Transaction;
            $withdraw->balance = $request->balance;
            $withdraw->user_id = Auth::user()->id;
            $withdraw->phone = $request->phone;
            $withdraw->amount = $request->amount;
            $withdraw->amount_deposit = $request->deposit;
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
        return view('setting');
    }

    public function saveSettings(Request $request)
    {
        try {

            if($request->minimum > $request->maximum) {
                return redirect()->route('setting')->with('error','Minimum withdraw must be less than Maximum withdraw');
            }

            $setting = DB::table('setting')->insert([
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
}
