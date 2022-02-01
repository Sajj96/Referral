<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Withdraw;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    /**
     * Show the withdraw page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('withdraw.withdraw');
    }

    /**
     * Show the withdraw history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $withdraws = Withdraw::where('user_id', Auth::user()->id)->get();
        $serial = 1;
        return view('withdraw.history', compact('withdraws','serial'));
    }

    /**
     * Show the withdraw page.
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

        if($validator->failed()) {
            return redirect()->route('withdraw')->with('error','Only valid details are required!');
        }

        try {
            $withdraw = new Withdraw;
            $withdraw->balance = $request->balance;
            $withdraw->user_id = Auth::user()->id;
            $withdraw->phone = $request->phone;
            $withdraw->amount = $request->amount;
            $withdraw->status = Withdraw::WITHDRAW_PENDING;
            if($withdraw->save()) {
                return redirect()->route('withdraw')->with('success','You have successfully withdrawn TZS'.$request->amount.'. Please wait for confirmation!.');
            }
        } catch (\Exception $e) {
            return redirect()->route('withdraw')->with('error','Something went wrong while withdrawing!');
        }
    }
}
