<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\Post;
use App\Models\PostReaction;
use App\Models\User;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masleida   = Post::where('status', 4)->orderBy('views', 'desc')->first();
        
        $masleido   = Editor::where('status', 1)->orderBy('vistas', 'desc')->first();
        $masleido->user = User::find($masleido->user_id);
        
        $masshare   = Post::where('status', 4)->orderBy('shareds', 'desc')->first();
        
        $posts      = Post::where('status', 4)->get();
        $intSLike   = 0;
        $intLike    = 0;
        $intNLike   = 0;

        $masslike   = [];
        $maslike    = [];
        $masnlike   = [];

        foreach($posts as $post){
            $slikes = PostReaction::where('post_id', $post->id)->where('reaction', 1)->orderBy('id', 'asc')->get();
            
            if(isset($slikes) && $slikes->count() > $intSLike){
                $post->slikes = $slikes->count();
                $masslike = $post;
            }

            $likes = PostReaction::where('post_id', $post->id)->where('reaction', 1)->orderBy('id', 'asc')->get();
            
            if(isset($likes) && $likes->count() > $intLike){
                $post->likes = $likes->count();
                $maslike = $post;
            }    
                    

            $nlikes = PostReaction::where('post_id', $post->id)->where('reaction', 3)->orderBy('id', 'asc')->get();
            
            if(isset($nlikes) && $nlikes->count() > $intNLike)  {
                $post->nlikes = $nlikes->count();
                $masnlike = $post;
            }  
                

        }
        //return $masleido;
        return view('admin.statistics.index', compact('masleida', 'masleido', 'masshare', 'masslike', 'maslike', 'masnlike'));
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
        //
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
}
