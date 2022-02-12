<?php

namespace App\Http\Controllers;

use App\Models\WhatsAppStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WhatsAppStatusController extends Controller
{
    public function index()
    {
        return view('whatsapp.view_status');
    }

    /**
     * Show status add page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('whatsapp.add_status');
    }

    /**
     * Add whatsapp status.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string',
            'image'   => 'required|file|mimes:png,jpeg,gif,jpeg'
        ]);

        if($validator->fails()) {
            return redirect()->route('whatsapp.show')->with('error','Only valid details are required!');
        }

        try {

            $fileName = $request->image->getClientOriginalName();
            $extension = $request->file('image')->extension();
            $generated_name = uniqid()."_".time().date("Ymd")."_IMG";
            if($extension == "png") {
                $fileName = $generated_name.".png";
            } else if($extension == "jpg") {
                $fileName = $generated_name.".jpg";
            } else if($extension == "jpeg") {
                $fileName = $generated_name.".jpeg";
            } else {
                request()->session()->put('danger', "Invalid file type only png, jpeg and jpg files are allowed.");
            }
            $filePath = $request->file('image')->storeAs('whatsapp_statuses', $fileName);
            $type = pathinfo($filePath, PATHINFO_EXTENSION);
            $image_data = File::get(storage_path('/app/whatsapp_statuses/'.$fileName));
            $base64encodedString = 'data:image/' . $type . ';base64,' . base64_encode($image_data);
            $fileBin = file_get_contents($base64encodedString);

            $whatsapp_status = new WhatsAppStatus;
            $whatsapp_status->media = $fileName;
            $whatsapp_status->description = strip_tags($request->title);
            $whatsapp_status->status = $request->status;
            if($whatsapp_status->save()){
                return redirect()->route('whatsapp.show')->with('success','WhatsApp Status added successfully!');
            }
            file_put_contents("/app/whatsapp_statuses/".$fileName, $fileBin);

        } catch (\Exception $e) {
            return redirect()->route('whatsapp.show')->with('error',$e->getMessage());
        }
    }
}
