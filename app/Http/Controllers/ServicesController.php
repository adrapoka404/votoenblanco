<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function related(Request $request){
        $related = Post::where('title', 'like', '%'.$request->search .'%')->get();
        return $related;
    }

    public function posts(Request $request){
        
        $posts = Post::where('title', 'like', '%'.$request->search .'%')->get();
        return $posts;
    }
}
