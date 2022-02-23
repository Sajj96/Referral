<?php

namespace App\Http\Controllers;

use App\Models\VideoUsers;
use Illuminate\Http\Request;

class VideoUsersController extends Controller
{
    public function create(Request $request)
    {

        try {

            $video_user = new VideoUsers;
            $video_user->video_id = $request->video_id;
            $video_user->user_id = $request->user_id;
            $video_user->save();

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
}
