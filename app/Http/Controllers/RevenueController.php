<?php

namespace App\Http\Controllers;

use App\Models\Revenue;
use Illuminate\Http\Request;

class RevenueController extends Controller
{
    public function index()
    {
        return view('revenue');
    }

    /**
     * Add revenue.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        try {
            $revenue = new Revenue;
            $revenue->user_id = $request->user_id;
            $revenue->type = $request->type;
            $revenue->amount = $request->amount;
            if($revenue->save()){
                return redirect()->route('revenue')->with('success','Revenue added successfully!');
            }
        } catch (\Exception $e) {
            return redirect()->route('revenue')->with('error','Something went wrong while adding revenue!');
        }
    }
}
