<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class QuestionController extends Controller
{
    /**
     * Show the questions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions = Question::all();
        $questionsList = array();

        foreach($questions as $key=>$rows){
            $questionsList[] = array(
                "numb" => $rows->id,
                "question" => $rows->question,
                "answer" => $rows->answer,
                "options" => explode(",", $rows->options)
            );
        }
        return view('question.questions', compact('questionsList'));
    }

    /**
     * Show the questions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function getList()
    {
        $questions = Question::all();
        $serial = 1;
        return view('question.questions_list', compact('questions', 'serial'));
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

    /**
     * Add questions score.
     *
     * @return \Illuminate\Http\Response
     */
    public function addScore(Request $request)
    {
        try {
            $score = DB::table('question_scores')->insert([
                'user_id' => $request->user_id,
                'score'   => $request->score,
                'created_at' => (new Carbon('now'))->format('Y-m-d H:m:s'),
                'updated_at' => (new Carbon('now'))->format('Y-m-d H:m:s')
            ]);
            return $score;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show question participants.
     *
     * @return \Illuminate\Http\Response
     */
    public function getParticipants(Request $request)
    {
        $participants = DB::table('question_scores')
                        ->join('users', 'question_scores.user_id', '=','users.id')
                        ->select(DB::raw('SUM(score) as score'),DB::raw('users.username'))
                        ->groupBy(DB::raw('users.id'))
                        ->get();
        $serial = 1;
        return view('question.participants', compact('participants','serial'));
    }

}
