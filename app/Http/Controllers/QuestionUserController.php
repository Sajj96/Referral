<?php

namespace App\Http\Controllers;

use App\Models\QuestionUser;
use Illuminate\Http\Request;

class QuestionUserController extends Controller
{
    public function create(Request $request)
    {

        try {

            $question_user = new QuestionUser;
            $question_user->question_id = $request->question_id;
            $question_user->user_id = $request->user_id;
            $question_user->save();

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
