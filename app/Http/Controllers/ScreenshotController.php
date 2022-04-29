<?php

namespace App\Http\Controllers;

use App\Models\Screenshot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class ScreenshotController extends Controller
{
    public function index()
    {
        return view('whatsapp.upload_screenshot');
    }

    /**
     * Scrren shots list.
     *
     * @return \Illuminate\Http\Response
     */
    public function getScreenshots()
    {
        if(Auth::user()->user_type != 1) {
            $screenshots = Screenshot::where('user_id', Auth::user()->id)->get();
            $serial = 1;
            return view('whatsapp.screenshots', compact('screenshots', 'serial'));
        }

        $screenshots = DB::table('screenshots')
                            ->join('users','screenshots.user_id','users.id')
                            ->select('screenshots.*','users.username','users.name')
                            ->where('screenshots.status',Screenshot::SCREENSHOT_PENDING)
                            ->get();
        $serial = 1;
        return view('whatsapp.screenshots', compact('screenshots', 'serial'));
    }

    public function getDetails($id)
    {
        $screenshot = DB::table('screenshots')
                            ->join('users','screenshots.user_id','users.id')
                            ->select('screenshots.*','users.username','users.name','users.id as user_id')
                            ->where('screenshots.id', $id)
                            ->first();

        return view('whatsapp.screenshot_details', compact('screenshot'));
    }

    /**
     * Upload screenshot.
     *
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image'   => 'required|file|mimes:png,jpeg,gif,jpeg'
        ]);

        if($validator->fails()) {
            return redirect()->route('screenshot')->with('error','Only valid details are required!');
        }

        try {

            $user = Auth::user();
            $check_screenshot = Screenshot::where('user_id', $user->id)->get();
            $today = date('d-m-Y');

            foreach($check_screenshot as $key=>$rows){
                $created_date = date('d-m-Y', strtotime($rows->created_at));
                
                if($today == $created_date){
                    return redirect()->route('screenshot')->with('error', "You can upload only one screenshot per day.");
                }
            }

            $fileName = $request->image->getClientOriginalName();
            $extension = $request->file('image')->extension();
            $generated_name = uniqid()."_".time().date("Ymd")."_SCREENSHOT";
            if($extension == "png") {
                $fileName = $generated_name.".png";
            } else if($extension == "jpg") {
                $fileName = $generated_name.".jpg";
            } else if($extension == "jpeg") {
                $fileName = $generated_name.".jpeg";
            } else {
                return redirect()->route('screenshot')->with('error', "Invalid file type only png, jpeg and jpg files are allowed.");
            }
            $filePath = $request->file('image')->storeAs('screenshots', $fileName,'public');
            $type = pathinfo($filePath, PATHINFO_EXTENSION);
            $image_data = File::get(storage_path('/app/public/screenshots/'.$fileName));
            $base64encodedString = 'data:image/' . $type . ';base64,' . base64_encode($image_data);
            $fileBin = file_get_contents($base64encodedString);

            $screenshot = new Screenshot;
            $screenshot->user_id = $user->id;
            $screenshot->screenshot = $fileName;
            $screenshot->status = Screenshot::SCREENSHOT_PENDING;
            if($screenshot->save()) {
                return redirect()->route('screenshot')->with('success','Screenshot submitted successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('screenshot')->with('error','Something went wrong while uploading screenshot!');
        }
    }

    /**
     * Reject screenshot.
     *
     * @return \Illuminate\Http\Response
     */

    public function decline(Request $request)
    {
        try {
            $screenshot = Screenshot::find($request->id);
            $screenshot->status = Screenshot::SCREENSHOT_REJECTED;
            if($screenshot->save()){
                return redirect()->route('screenshot.details',$request->id)->with('success','Screenshot declined!');
            }
        } catch (\Exception $e) {
            return redirect()->route('screenshot.details',$request->id)->with('error','Something went wrong while rejecting screenshot!');
        }
    }
}
