<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Add a new comment
     */
    public function addComment(Request $request)
    {
        
        $post_id = $request->newComment['post_id'];
        $comment = $request->newComment['comment'];

        Comment::create(['post_id' => $post_id, 'comment' => $comment]);

    }

    public function getAllComments()
    {
        $data = Comment::orderBy('id', 'DESC')->get();
        return json_encode($data);
    }
}
