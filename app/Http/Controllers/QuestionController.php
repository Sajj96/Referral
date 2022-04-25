<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Question;
use App\Models\QuestionUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;

class QuestionController extends Controller
{
    /**
     * Show the questions page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $questions_all = Question::where('status', Question::PUBLISH_STATUS)->get();
        $questionsList = array();
        $trivia_questions = array();
        $user = Auth::user();
        $question_ids = array();
        $question_users = DB::table('question_users')
                            ->select('question_id')
                            ->where('user_id', $user->id)
                            ->get();
        $question_numb = 1;
        foreach($question_users as $key=>$rows) {
            array_push($question_ids,$rows->question_id);
        }

        foreach($questions_all as $key=>$rows){
            if(!in_array($rows->id, $question_ids)) {
                $questionsList[] = array(
                    "id"  => $rows->id,
                    "numb" => $question_numb++,
                    "question" => $rows->question,
                    "answer" => $rows->answer,
                    "options" => explode(",", $rows->options)
                );
            }
            array_push($trivia_questions,$rows->id);
        }
         
        $check_attempted = array_diff($trivia_questions, $question_ids);

        return view('question.questions', compact('questions_all','questionsList','question_ids','check_attempted'));
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
     * Show the questions edit page.
     *
     *
     */
    public function edit($id)
    {
        $question = Question::find($id);
        return view('question.edit', compact('question','id'));
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
            $question->status = $request->status;
            if($question->save()) {
                return redirect()->route('question.show')->with('success','Question created successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('question.show')->with('error','Something went wrong while creating a question!');
        }
    }

    /**
     * Create question.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string',
            'answer'   => 'required',
            'options'  => 'required'
        ]);

        if($validator->fails()) {
            return redirect()->route('question.edit', $request->id)->with('error','Only valid details are required!');
        }

        try {
            $question = Question::where('id', $request->id)->first();
            $question->question = strip_tags($request->question);
            $question->answer = $request->answer;
            $question->options = $request->options;
            $question->status = $request->status;
            if($question->save()) {
                return redirect()->route('question.edit', $request->id)->with('success','Question updated successfully');
            }
        } catch (\Exception $e) {
            return redirect()->route('question.edit', $request->id)->with('error','Something went wrong while updating a question!');
        }
    }

    /**
     * Create question.
     *
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        try {
            $question = Question::find($request->id);
            if($question->delete()){
                DB::table('question_users')->where('question_id','=',$request->id)->delete();
                return true;
            }
        } catch (\Exception $e) {
            return redirect()->route('question.show')->with('error','Something went wrong while deleting a question!');
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
        $questions_all = Question::where('status', Question::PUBLISH_STATUS)->get(); 

        $participants = DB::table('question_scores')
                        ->join('users', 'question_scores.user_id', '=','users.id')
                        ->select(DB::raw('SUM(score) as score'),DB::raw('users.username'))
                        ->groupBy(DB::raw('users.id'))
                        ->get();
        $serial = 1;
        return view('question.participants', compact('participants','serial','questions_all'));
    }

}
