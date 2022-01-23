<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReferralController extends Controller
{
     /**
     * Show the referral page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referral');
    }
}
