<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Category;
use App\Models\Editor;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\PostDetails;
use App\Models\Postrelated;
use App\Models\PostStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use League\OAuth1\Client\Server\Tumblr;

use function PHPUnit\Framework\returnSelf;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Post $posts)
    {

        $query = $posts->newQuery();

        if ($request->has('filter_title')) {
            $filter_title = $request->filter_title;
            $query->where('title', 'like', '%' . $filter_title . '%');
        } else
            $filter_title = '';

        if ($request->has('filter_editor')) {
            $filter_editor = $request->filter_editor;
            $query->where('user_create', $filter_editor);
        } else
            $filter_editor = 0;

        if ($request->has('filter_status')) {
            $filter_status = $request->filter_status;
            $query->where('status', $filter_status);
        } else
            $filter_status = 0;

        $roles = Auth::user()->roles()->get();
        $editor = false;

        foreach ($roles as $role) {
            if ($role->name == 'Coordinación de Contenido Editorial')
                $editor = true;
        }

        if ($editor)
            $posts      = $query->orderBy('created_at', 'desc')->paginate(15);
        else
            $posts      = $query->where('user_create', Auth::user()->id)->orderBy('created_at', 'desc')->paginate(15);

        $statuses   = PostStatus::all();

        foreach ($posts as &$post) {
            $post->status = PostStatus::find($post->status);

            $post->user = User::find($post->user_create);

            $post->editor = Editor::where('user_id', $post->user->id)->first();
        }

        $editors = User::role('Creador de Contenido')->get();

        $headers = ['Título', 'Editor', 'Estado', 'Acciones'];
        
        return view('admin.posts.index', compact('posts', 'headers', 'statuses', 'editor', 'editors', 'filter_status', 'filter_title', 'filter_editor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('nombre', 'asc')->get();

        $roles = Auth::user()->roles()->get();
        $editor = false;

        foreach ($roles as $role) {
            if ($role->name == 'Coordinación de Contenido Editorial')
                $editor = true;
        }

        return view('admin.posts.create', compact('categories', 'editor'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {

        //return $request;
        //$nurl = Storage::put('public/posts/'.date('Y_m'),$request->file('image_principal'));

        //Es creador de contenido?
        $roles = Auth::user()->roles()->get();
        $editor = false;

        foreach ($roles as $role) {
            if ($role->name == 'Creador de contenido')
                $editor = true;
        }

        $post = new Post();

        $post->user_create          = Auth::user()->id;
        $post->title                = $request->title;
        $post->slug                 = strtolower(str_replace(' ', '-', $request->title));
        $post->description          = $request->description;
        $post->featured             = isset($request->featured) ? 1 : 0;
        $post->social_text          = $request->social_text;
        $post->slug_description     = strtolower(str_replace(' ', '-', $request->description));
        $post->image_principal      = $request->image_principal;
        
        if(!$editor)
            $post->status = 4;

            //return $post;
        $post->save();

        $post_details = new PostDetails();

        $post_details->post_id  = $post->id;
        $post_details->body     = $request->body;
        $post_details->tags     = $request->tags;
        $post_details->keywords = $request->keywords;

        if ($request->date) {
            $post_details->posted       = $request->date;
            $post_details->posted_time  = $request->time;
        }

        if ($request->posted_now)
            $post_details->posted_now = $request->posted_now;

        if ($request->redfb)
            $post_details->redfb = $request->redfb;

        if ($request->redtw)
            $post_details->redtw = $request->redtw;

        $post_details->save();

        foreach ($request->all()['categories'] as $category => $label) {
            $postCategory = new Postcategory();

            $postCategory->post_id = $post->id;
            $postCategory->category_id = $category;

            $postCategory->save();
        }

        if (isset($request->all()['related'])) {
            foreach ($request->all()['related'] as $related => $label) {

                $postRelated = new Postrelated();

                $postRelated->post_id = $post->id;
                $postRelated->related_id = $related;

                $postRelated->save();

                $postRelated = new Postrelated();

                $postRelated->post_id = $related;
                $postRelated->related_id = $post->id;

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
    public function show(Request $request, $id)
    {
        return $request;
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
        $post = Post::find($id);
        $post->details = PostDetails::where('post_id', $post->id)->first();

        $postcategories = Postcategory::where('post_id', $post->id)->get();
        $postrelated = Postrelated::where('post_id', $post->id)->get();

        $cats = [];
        foreach ($postcategories as $category)
            $cats[] = Category::find($category->category_id);

        $post->categories = $cats;

        $relateds = [];
        foreach ($postrelated as $related)
            $relateds[] = Post::find($related->post_id);

        $post->related = $relateds;

        $categories = Category::orderBy('nombre', 'asc')->get();

        $roles = Auth::user()->roles()->get();
        $editor = false;

        foreach ($roles as $role) {
            if ($role->name == 'Coordinación de Contenido Editorial')
                $editor = true;
        }
return $post;
        return view('admin.posts.edit', compact('categories', 'post', 'editor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePostRequest $request, $id)
    {
        $post = Post::where('slug', $id)->first();

        $post->user_edit            = Auth::user()->id;
        $post->title                = $request->title;
        $post->slug                 = strtolower(str_replace(' ', '-', $request->title));
        $post->description          = $request->description;
        $post->featured             = isset($request->featured) ? 1 : 0;
        $post->social_text          = $request->social_text;
        $post->slug_description     = strtolower(str_replace(' ', '-', $request->description));
        $post->image_principal      = $request->image_principal;

        $post->save();

        PostDetails::where('post_id', $post->id)->delete();

        $post_details = new PostDetails();

        $post_details->post_id  = $post->id;
        $post_details->body     = $request->body;
        $post_details->tags     = $request->tags;
        $post_details->keywords = $request->keywords;

        if ($request->date) {
            $post_details->posted       = $request->date;
            $post_details->posted_time  = $request->time;
        }

        if ($request->posted_now)
            $post_details->posted_now = $request->posted_now;

        if ($request->redfb)
            $post_details->redfb = $request->redfb;

        if ($request->redtw)
            $post_details->redtw = $request->redtw;

        $post_details->save();

        Postcategory::where('post_id', $post->id)->delete();

        foreach ($request->all()['categories'] as $category => $label) {
            $postCategory = new Postcategory();

            $postCategory->post_id = $post->id;
            $postCategory->category_id = $category;

            $postCategory->save();
        }

        Postrelated::where('post_id', $post->id)->delete();
        Postrelated::where('related_id', $post->id)->delete();

        if (isset($request->all()['related'])) {
            foreach ($request->all()['related'] as $related => $label) {

                $postRelated = new Postrelated();

                $postRelated->post_id = $post->id;
                $postRelated->related_id = $related;

                $postRelated->save();

                $postRelated = new Postrelated();

                $postRelated->post_id = $related;
                $postRelated->related_id = $post->id;

                $postRelated->save();
            }
        }

        return redirect()->route('admin.notas.create')->with('info', __($post->title . ' editado con éxito'));
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

    public function change_status( Request $request)
    {
        $post = Post::find($request->post_id);
        $post->status = $request->status_id;
        $post->save();

        return redirect()->route('admin.notas.index')->with('info', __($post->title . ' editado con éxito'));
    }
}
