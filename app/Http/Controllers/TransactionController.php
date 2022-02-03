<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TransactionController extends Controller
{
    /**
     * Show the history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $withdraws = Transaction::where('user_id', Auth::user()->id)->get();
        $serial = 1;
        return view('transaction.history', compact('withdraws','serial'));
    }

    /**
     * Show the withdraw page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('transaction.withdraw');
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
}
