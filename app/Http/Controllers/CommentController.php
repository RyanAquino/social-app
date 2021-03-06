<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Post;
use App\User;
use App\Http\Resources\Comment as CommentResource;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    public function __construct() {
        $this->middleware(['auth:api']);
    }

    public function getPostComments(Request $request){
        $postId = $request->route('id');
        
        $comments = DB::table('users')
        ->join('comments','comments.user_id','=','users.id')
        ->where('comments.post_id','=',$postId)->orderBy('comments.created_at','desc')->get();

        return $comments;
    }
}
