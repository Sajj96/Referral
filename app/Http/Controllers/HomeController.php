<?php

namespace App\Http\Controllers;

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
