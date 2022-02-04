<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\Transaction;

class UserController extends Controller
{
    /**
     * Show the users page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $serial = 1;
        return view('user.users', compact('users','serial'));
    }

    /**
     * Show the user details page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUser(Request $request, $id)
    {
        $user = User::find($id);
        $transactions = Transaction::where('user_id', $user->id)->get();
        $serial = 1;
        return view('user.user_details', compact('user', 'transactions', 'serial'));
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

    public function activateUser(Request $request, $id)
    {
        try {
            $user = User::where('id',$id)->first();
            $user->active = User::USER_STATUS_ACTIVE;
            if($user->save()) {
                return redirect()->route('user.details', $id)->with('success','User activated successfully!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('user.details', $id)->with('error','User was not activated');
        }
    }

    public function deactivateUser(Request $request, $id)
    {
        try {
            $user = User::where('id',$id)->first();
            $user->active = User::USER_STATUS_BLOCKED;
            if($user->save()) {
                return redirect()->route('user.details', $id)->with('success','User deactivated successfully!');
            }
        } catch (\Throwable $th) {
            return redirect()->route('user.details', $id)->with('error','User was not deactivated');
        }
    }
}
