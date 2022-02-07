<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $userModel  = new User();
        $activeReferrals = $userModel->activeReferrals();

        $downlines = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->select(DB::raw('t2.username as username'),DB::raw('t2.phone as phone'),DB::raw('t2.active as active'))
                        ->where(DB::raw('t1.id'), DB::raw($user->id))
                        ->get();
        $serial = 1;
        return view('team.level_one', compact('downlines', 'serial', 'activeReferrals'));
    }

    /**
     * Show the Level 2 page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLevelTwo()
    {
        $user = Auth::user();
        $userModel  = new User();
        $activeReferrals = $userModel->activeReferrals();

        $downlines = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                        ->select(DB::raw('t3.username as username'),DB::raw('t3.phone as phone'),DB::raw('t3.active as active'))
                        ->where(DB::raw('t1.id'), DB::raw($user->id))
                        ->get();
        $serial = 1;
        return view('team.level_two', compact('downlines', 'serial', 'activeReferrals'));
    }

    /**
     * Show the Level 3 page.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLevelThree()
    {
        $user = Auth::user();
        $userModel  = new User();
        $activeReferrals = $userModel->activeReferrals();

        $downlines = DB::table('users','t1')
                        ->leftJoin('users as t2', 't2.referrer_id','=','t1.id')
                        ->leftJoin('users as t3', 't3.referrer_id','=','t2.id')
                        ->leftJoin('users as t4', 't4.referrer_id','=','t3.id')
                        ->select(DB::raw('t4.username as username'),DB::raw('t4.phone as phone'),DB::raw('t4.active as active'))
                        ->where(DB::raw('t1.id'), DB::raw($user->id))
                        ->get();
        $serial = 1;
        return view('team.level_three', compact('downlines', 'serial','activeReferrals'));
    }
}
