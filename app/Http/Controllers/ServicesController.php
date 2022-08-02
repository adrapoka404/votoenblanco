<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;

class ServicesController extends Controller
{
    public function related(Request $request){
        $related = Post::where('title', 'like', '%'.$request->search .'%')->get();
        return $related;
    }

    public function posts(Request $request){
        
        $posts_response=[];
        $posts = Post::where('title', 'like', '%'.$request->search .'%')->get();
        foreach($posts as $post)   
            $posts_response[$post->id] = $post;

        $categories = Category::where('nombre', 'like', '%'.$request->search.'%');

        foreach($categories as $category){
            $postByCategory = Postcategory::where('category_id', $category->id);

            foreach($postByCategory as $pbc)
                $posts_response[$pbc->id] = $pbc;
        }


        return $posts_response;
    }
}
