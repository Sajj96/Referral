<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuestionController extends Controller
{
    /**
     * Show the questions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('question');
    }
}
