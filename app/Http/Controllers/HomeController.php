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
        $profit = $transactions->getProfit();
        $balance = $transactions->getUserBalance();
        $withdrawn = $transactions->getUserWithdrawnAmount();
        $whatsapp = $transactions->getWhatsAppEarnings();
        $question = $transactions->getQuestionsEarnings();
        $video = $transactions->getVideoEarnings();

        $user = new User();
        $all_users = $user->getAllUsers();
        $active_users = $user->getAllActiveUsers();
        $withdraw_requests = $transactions->getWithdrawRequests();
        $system_earnings = $transactions->getSystemEarnings();
        $transactionData = Transaction::where('transaction_type',Transaction::TYPE_WITHDRAW)
                                        ->where('status',Transaction::WITHDRAW_SUCCESS)
                                        ->get();

        $dayofweek = date('w', strtotime('2022-02-18'));
        $result = date('Y-m-d', strtotime((0 - $dayofweek).' day', strtotime('2022-02-18')));
        $todayEarning = 0;
        $todayWithdraw = 0;
        $today = date('Y-m-d');

        foreach($transactionData as $key => $rows) {
            $created_at = date('Y-m-d',strtotime($rows->created_at));
            if($created_at == $today) {
                $todayEarning += $rows->fee;
                $todayWithdraw += $rows->amount;
            }
        }

        $users = User::all();

        $inactiveUsers = User::where('active', 0)->get();

        $newUsers = array();

        foreach($users as $key => $rows) {
            $created_at = date('Y-m-d',strtotime($rows->created_at));
            if($created_at == $today) {
                $newUsers[] = $rows;
            }
        }

        if(Auth::user()->user_type != 1) {
            return view('home', compact('profit','balance','withdrawn','whatsapp','question','video'));
        }

        return view('home', compact('all_users','active_users','withdraw_requests','system_earnings','transactionData','todayEarning','todayWithdraw','newUsers','inactiveUsers'));
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
