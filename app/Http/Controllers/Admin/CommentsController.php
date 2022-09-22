<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\PostComent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, PostComent $comments)
    {
        $query = $comments->newQuery();

        if ($request->post_id) {
            $post_id = $request->post_id;
            $query->where('post_id', $post_id);
        } else
            $post_id = '';

        if ($request->user_id) {
            $user_id = $request->user_id;
            $query->where('email', $user_id);
        } else
            $user_id = '';

        if ($request->has('status')) {
            $status = $request->status;
            $query->where('status', $status);
        } else
            $status = '';

        $comments = $query->orderBy('id', 'desc')->paginate(15);

        //return $comments;

        //$comments = PostComent::orderBy('post_id', 'desc')->paginate(10);
        $headers = ['nota', 'usuario', 'commentario', 'fecha', 'acciones'];
        //dd($comments);
        if ($comments->count() > 0) {
            foreach ($comments as &$comment)
                $comment->post = Post::find($comment->post_id);


            foreach ($comments as $comment)
                $posts[$comment->post_id] = Post::find($comment->post_id);

            foreach ($comments as $comment)
                $users[$comment->email] = ['id' => $comment->email, 'name' => $comment->name];
        } else{
            $posts = [];
            $users = [];
        }

        return view('admin.comments.index', compact('comments', 'headers', 'posts', 'users', 'post_id', 'user_id', 'status'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return 'viene a create';
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
        $comment = PostComent::find($id);


        if ($comment->status == 0) {
            $comment->status = 1;
            $msg = 'El comentario de ' . $comment->name . ' se ha autorizado';
        } else {
            $comment->status = 0;
            $msg = 'El comentario de ' . $comment->name . ' se ha ocultado';
        }
        $comment->save();

        return redirect()->route('admin.comentarios.index')->with('info', $msg);
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
