<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Show the users page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile');
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        return view('profile');
    }

    /**
     * Edit user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        try {
            $user = User::where('username', Auth::user()->username)->where('email', Auth::user()->email)->first();
            if($user) {
                $user->name = $request->name;
                $user->username = $request->username;
                $user->phone = $request->phone;
                $user->country = $request->country;
                if($user->save()) {
                    return redirect()->route('profile')->with('success','Profile updated successfully!');
                }
            } 
        } catch (\Exception $e) {
            return redirect()->route('profile')->with('error','Please provide unique details!');
        }
    }
}
