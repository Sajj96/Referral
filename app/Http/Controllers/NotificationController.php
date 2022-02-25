<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::all();
        $serial = 1;
        return view('notification.notifications', compact('notifications','serial'));
    }

    public function show()
    {
        return view('notification.send');
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message' => 'required|string'
        ]);

        if($validator->fails()) {
            return redirect()->route('notify.show')->with('error','Only valid details are required!');
        }

        try {
            $notification = new Notification;
            $notification->message = strip_tags($request->message);
            $notification->type = $request->type;
            if($notification->save()) {
                return redirect()->route('notify.show')->with('success','Notification sent successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('notify.show')->with('error','Something went wrong while sending notification!');
        }
    }
}
