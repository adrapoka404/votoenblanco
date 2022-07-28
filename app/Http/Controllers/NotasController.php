<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Posts;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\User;
use Illuminate\Http\Request;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($who)
    {

        return view('guest.notas', compact('who')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('guest.nota'); 
    }

    public function editores($id)
    {
        $editor = User::find($id);
        
        $who = $editor->name;

        $posts = Post::where('user_create', $id )->get();
        
        if($posts) {
           foreach($posts as &$post)
                $post->user = User::find($post->user_create);
        }
           // return $posts;
        return view('guest.notas', compact('editor','posts','who')); 
    }

    public function categorias( $request ) {
        $posts = [];
        $category = Category::find($request);
        //return $category;
        $who = $category->nombre;

        $postCategory = Postcategory::where('category_id', $category->id )->get();
        if($postCategory) {
            $ids = [];
            foreach($postCategory as $pc) 
                $ids[] = $pc->post_id;

                $posts = Post::whereIn('id', $ids)->get();
                foreach($posts as &$post)
                    $post->user = User::find($post->user_create);
            }
            //return $posts;
        return view('guest.notas', compact('category', 'posts', 'who')); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admin(){
        
    }
}
