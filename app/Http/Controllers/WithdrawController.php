<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WithdrawController extends Controller
{
    /**
     * Show the withdraw history page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('withdraw.history');
    }
}
