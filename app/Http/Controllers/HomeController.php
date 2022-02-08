<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
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

        $user = new User();
        $all_users = $user->getAllUsers();
        $active_users = $user->getAllActiveUsers();
        $withdraw_requests = $transactions->getWithdrawRequests();
        $system_earnings = $transactions->getSystemEarnings();

        if(Auth::user()->user_type != 1) {
            return view('home', compact('profit','balance','expenses','withdrawn'));
        }

        return view('home', compact('all_users','active_users','withdraw_requests','system_earnings'));
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
