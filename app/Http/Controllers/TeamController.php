<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    /**
     * Show the Level 1 page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $downlines = User::where('referrer_id', $user->id)->get();
        $serial = 1;
        return view('team', compact('downlines', 'serial'));
    }
}
