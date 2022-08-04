<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Livewire\Statusposts;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\PostDetails;
use App\Models\Postrelated;
use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::where('user_create', Auth::user()->id)->orderBy('title', 'asc')->paginate(5);

        foreach($posts as &$post) {
            $status = PostStatus::find($post->status);
            $post->status = $status;

            $user = User::find($post->user_create);
            $post->user = $user;
        }
        
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('nombre', 'asc')->get();
        
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $nurl = Storage::put('posts/'.date('Y_m'),$request->file('image_principal'));
        $post = new Post();

        $post->user_create          = Auth::user()->id;
        $post->title                = $request->title;
        $post->slug                 = str_replace(' ', '-', $request->title);
        $post->description          = $request->description;
        $post->slug_description     = str_replace(' ', '-', $request->description);
        $post->image_principal      = $nurl;

        $post->save();

        $post_details = new PostDetails();

        $post_details->post_id  = $post->id;
        $post_details->body     = $request->body;
        $post_details->tags     = $request->tags;
        $post_details->keywords = $request->keywords;
         
        if($request->date)
            $post_details->posted = $request->date .' ' . $request->time;
        
        $post_details->save();

        foreach($request->all()['categories'] as $category => $label){
            $postCategory = new Postcategory();

            $postCategory->post_id = $post->id;
            $postCategory->category_id = $category;

            $postCategory->save();
        }

        if(isset($request->all()['related'])) {
            foreach($request->all()['related'] as $related => $label){
                
                    $postRelated = new Postrelated();
        
                    $postRelated->post_id = $post->id;
                    $postRelated->related_id = $related;
        
                    $postRelated->save();
                
            }
        }

        return redirect()->route('admin.notas.create')->with('info', __('Post creado con éxito'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.posts.preview');
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
