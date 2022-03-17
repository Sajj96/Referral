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
        $users = User::select("*")->orderBy("username")->get();
        $userObj = new User;
        $transaction = new Transaction();
        $transactions = Transaction::where('user_id', $user->id)->get();
        $profit = $transaction->getProfit($user->id);
        $balance = $transaction->getUserBalance($user->id);
        $level_1_downlines = $userObj->getLevelOneDownlines($user->id);
        $level_2_downlines = $userObj->getLevelTwoDownlines($user->id);
        $level_3_downlines = $userObj->getLevelThreeDownlines($user->id);
        $serial = 1;
        $serial_1 = 1;
        $serial_2 = 1;
        $serial_3 = 1;
        return view('user.user_details', compact('user','users', 'transactions', 'serial','serial_1','serial_2','serial_3','profit','balance','level_1_downlines','level_2_downlines','level_3_downlines'));
    }

    /**
     * Show the profile page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        $id = Auth::user()->id;
        $transactions = new Transaction();
        $profit = $transactions->getProfit($id);
        $balance = $transactions->getUserBalance($id);

        return view('profile', compact('profit','balance'));
    }

    /**
     * Edit user profile.
     *
     * @return \Illuminate\Http\Response
     */
    public function editProfile(Request $request)
    {
        try {
            $user = User::where('id', $request->user_id)->where('email', $request->email)->first();
            if($user) {
                $user->name = $request->name;
                $user->username = $request->username;
                $user->phone = $request->phone;
                $user->country = $request->country;
                $user->referrer_id = $request->referrer;
                if($user->save()) {
                    return redirect()->route('user.details', $request->user_id)->with('success','User Profile updated successfully!');
                }
            } 
        } catch (\Exception $e) {
            return redirect()->route('user.details', $request->user_id)->with('error','Please provide unique details!');
        }
    }

    public function activateUser(Request $request, $id)
    {
        try {
            $user = User::where('id',$id)->first();
            $user->active = User::USER_STATUS_ACTIVE;
            if($user->save()) {
                return redirect()->route('users')->with('success','User activated successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('users')->with('error','User was not activated');
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
        } catch (\Exception $th) {
            return redirect()->route('user.details', $id)->with('error','User was not deactivated');
        }
    }

    public function deleteUser(Request $request, $id)
    {
        try {
            $user = User::where('id',$id)->first();
            if($user->delete()) {
                return redirect()->route('users')->with('success','User deleted successfully!');
            }
        } catch (\Exception $th) {
            return redirect()->route('users')->with('error','User was not deleted');
        }
    }
}
