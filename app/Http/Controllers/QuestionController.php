<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Show the questions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->user_type == 1) {
            $questions = Question::all();
            $serial = 1;
            return view('question.questions', compact('questions', 'serial'));
        }
        return view('question.questions');
    }

    /**
     * Show the question creation page.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        return view('question.create');
    }

    /**
     * Create question.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer'   => 'required',
            'options'  => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('question.show')->with('error','Only valid details are required!');
        }

        try {
            $question = new Question;
            $question->question = strip_tags($request->question);
            $question->answer = $request->answer;
            $question->options = $request->options;
            if($question->save()) {
                return redirect()->route('question.show')->with('success','Question created successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('question.show')->with('error','Something went wrong while creating a question!');
        }
    }
}
