<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        return view('withdraw.history');
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
            
        }
    }
}
