<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReferralController extends Controller
{
     /**
     * Show the referral page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user  = new User();
        $activeReferrals = $user->activeReferrals();
        return view('referral', compact('activeReferrals'));
    }
}
