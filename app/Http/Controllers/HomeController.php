<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $transactions = new Transaction();
        $profit = $transactions->getUserTotalEarnings();
        $balance = $transactions->getUserBalance();
        $expenses = $transactions->getUserExpenses();
        $withdrawn = $transactions->getUserWithdrawnAmount();

        if(Auth::user()->user_type != 1) {
            return view('home', compact('profit','balance','expenses','withdrawn'));
        }

        return view('home');
    }

    /**
     * Show the payment information page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showPaymentInformationPage()
    {
        return view('payment');
    }
}
