<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{

    public function getAll()
    {
        $data = Post::orderBy('id', 'DESC')->get();
        return json_encode($data);
    }

    public function createPost(Request $request)
    {
        $name = $request->newPost['postName'];
        $description = $request->newPost['postDescription'];

        Post::create(['name' => $name, 'description' => $description]);
    }
}
