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
        return view('team.level_one', compact('downlines', 'serial'));
    }

    /**
     * Show the Level 2 page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLevelTwo()
    {
        $user = Auth::user();
        $downlines = User::where('referrer_id', $user->id)->get();
        $serial = 1;
        return view('team.level_two', compact('downlines', 'serial'));
    }

    /**
     * Show the Level 3 page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLevelThree()
    {
        $user = Auth::user();
        $downlines = User::where('referrer_id', $user->id)->get();
        $serial = 1;
        return view('team.level_three', compact('downlines', 'serial'));
    }
}
