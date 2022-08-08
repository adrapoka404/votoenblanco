<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Posts;
use App\Http\Requests\StoreComentsRequest;
use App\Models\Categories;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\PostComent;
use App\Models\PostDetails;
use App\Models\PostReaction;
use App\Models\Postrelated;
use App\Models\PostSaved;
use App\Models\User;
use App\View\Components\coment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function show($id, Request $request)
    {
        $post = Post::find($id);
        $post->views = $post->views + 1;
        $post->save();
        
        $post->details  = PostDetails::where('post_id', $id)->first();
        $relateds       = Postrelated::where('post_id', $id)->get();
        $categories     = Postcategory::where('post_id', $id)->get();
        $redactor       = User::find($post->user_create);
        $comments       = PostComent::where('post_id', $id)->where('status', 1)->get();


    
        if(!empty($relateds)){
    
            foreach($relateds as &$related) {
                $r = Post::find($related->related_id);
                $related->title = $r->title;
            }
        }

        if(!empty($categories)){
            foreach($categories as &$category) {
                $cat = Category::find($category->category_id);
                
                $category->name = $cat->nombre;
            }
        }

        $post->relateds     = $relateds;
        $post->categories   = $categories;
        $post->editor       = $redactor;
        $post->comments     = $comments;

        $post->saveme = false;
        $post->likeme = false;
        
        $slikes = PostReaction::where('reaction', 1)->where('post_id', $post->id)->get();

        $post->slikes = $slikes->count();

        $likes = PostReaction::where('reaction', 2)->where('post_id', $post->id)->get();

        $post->likes = $likes->count();

        $nlikes = PostReaction::where('reaction', 3)->where('post_id', $post->id)->get();

        $post->nlikes = $nlikes->count();

        if(PostReaction::where('post_id', $post->id)->where('user_id', $request->ip())->first())
                $post->likeme =true;

        if(Auth::user()) {
            if(PostSaved::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first())
                $post->saveme = true;

            if(PostReaction::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first())
                $post->likeme =true;
        }

        
        

        return view('guest.nota', compact('post')); 
    }

    public function editores($id)
    {
        $editor = User::find($id);
        
        $who = $editor->name;

        $posts = Post::where('user_create', $id )->orderBy('created_at', 'desc')->get();
        
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

                $posts = Post::whereIn('id', $ids)->orderBy('created_at', 'desc')->get();
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

    public function like(Request $request){
        $post       = $request->all()['post_id'];
        $reaction   = $request->all()['reaction'];
        
        if(Auth::user())
            $user = Auth::user()->id;
        else
            $user = $request->ip();
        
        $exist = PostReaction::where('post_id', $post)->where('user_id', $user)->first();

        $likes = PostReaction::where('post_id', $post)->where('reaction', $reaction)->get();

        if(!$exist){
            if(PostReaction::create(['user_id'=>$user, 'post_id'=>$post, 'reaction' => $reaction]))
                return ['success' => true, 'likes' => count($likes)];    
            else
            return ['error' => true];    
        } else {
            $exist->delete();
            return ['success' => true, 'likes' => count($likes) - 1];    
        }
            
    }

    public function slike(Request $request){
        
        $post       = $request->all()['post_id'];
        $reaction   = $request->all()['reaction'];
        
        if(Auth::user())
            $user = Auth::user()->id;
        else
            $user = $request->ip();
        
        $exist = PostReaction::where('post_id', $post)->where('user_id', $user)->first();

        $slikes = PostReaction::where('post_id', $post)->where('reaction', $reaction)->get();

        if(!$exist){
            if(PostReaction::create(['user_id'=>$user, 'post_id'=>$post, 'reaction' => $reaction]))
                return ['success' => true, 'slikes' => count($slikes)];    
            else
            return ['error' => true];    
        } else{
            $exist->delete();
            return ['success' => true, 'slikes' => count($slikes)-1];
        }
            
     }

     public function nolike(Request $request){
        $post       = $request->all()['post_id'];
        $reaction   = $request->all()['reaction'];
        
        if(Auth::user())
            $user = Auth::user()->id;
        else
            $user = $request->ip();
        
        $exist = PostReaction::where('post_id', $post)->where('user_id', $user)->first();

        $nolikes = PostReaction::where('post_id', $post)->where('reaction', $reaction)->get();

        if(!$exist){
            if(PostReaction::create(['user_id'=>$user, 'post_id'=>$post, 'reaction' => $reaction]))
                return ['success' => true, 'nolikes' => count($nolikes)];    
            else
            return ['error' => true];    
        } else {
            $exist->delete();
            return ['success' => true, 'nolikes' => count($nolikes)-1];
        }
     }

     public function share($id){
        return $id;
         $post = Post::find($id);
         
         $post->like = $post->like + 1;
 
         $post->save();
 
         return redirect()->route('nota.show', $id);
     }

    public function save(Request $request){
        if(Auth::user()){
            $post = $request->all()['save']['post_id'];
            $user = Auth::user()->id;

            $exist = PostSaved::where('post_id', $post)->where('user_id', $user)->first();
            
            if(!$exist)
                PostSaved::create(["user_id" => $user, "post_id" => $post]);
            else
                $exist->delete();
            
            return ['success'=>true];
        } else
            return ['error'=>true];
    }

    public function nosave(Request $request){
        $post = $request->all()['post_id'];
        $user = Auth::user()->id;
        
        $exist = PostSaved::where('post_id', $post)->where('user_id', $user)->delete();

        if($exist)
            return ['success'=>true];
        else
            return ['error'=>true];
     }

     public function coments(StoreComentsRequest $request){
        $coment = $request->all()['coment'];

        $user = User::where('email', $coment['email'])->first();

        if($user) 
            $coment['user_id'] = $user->id;
        
        //demomento
        $coment['status'] = 1;

        PostComent::create($coment);

        return ['success'=> true, 'msg' => '¡Exito! Gracias por darnos tu opinion'];
     }
}
