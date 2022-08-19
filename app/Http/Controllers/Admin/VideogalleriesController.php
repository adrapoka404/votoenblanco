<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVidegaleria;
use App\Models\Post;
use App\Models\VideoGallery;
use App\Models\VideoPosts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VideogalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vgalerias = VideoGallery::paginate(10);
        $headers = ['nombre', 'descripción', 'accciones'];

        return view('admin.videogalleries.index', compact('vgalerias', 'headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.videogalleries.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVidegaleria $request)
    {
        //return $request;
        $vgallery = new VideoGallery();

        $vgallery->name         = $request->name;
        $vgallery->description  = $request->description;
        $vgallery->url          = $request->url;
        $vgallery->user_create  = Auth::user()->id;

        $vgallery->save();

        if(isset($request->related)){
            foreach($request->related as $post_id => $related){
                $vgRealated = new VideoPosts();

                $vgRealated->post_id = $post_id;
                $vgRealated->video_gallery_id = $vgallery->id;
                $vgRealated->save();
            }

        }

        return redirect()->route('admin.videogalerias.index')->with('info', 'Videogaleria ' . $vgallery->name . ' creada con exito.' );

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
        $vgallery = VideoGallery::find($id);
        $relateds = [];
        if($posts = VideoPosts::where('video_gallery_id', $vgallery->id)->get()){
            
            foreach($posts as $post){
                $p = Post::find($post->post_id);
                $relateds[] = ['id' => $p->id, 'title'=> $p->title];
            }
        }

        $vgallery->related = $relateds;
        return view('admin.videogalleries.edit', compact('vgallery'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreVidegaleria $request, $id)
    {
        $vgallery = VideoGallery::find($id);

        $vgallery->name         = $request->name;
        $vgallery->description  = $request->description;
        $vgallery->url          = $request->url;
        $vgallery->user_edit    = Auth::user()->id;

        $vgallery->save();

        VideoPosts::where('video_gallery_id', $vgallery->id)->delete();

        if(isset($request->related)){
            foreach($request->related as $post_id => $related){
                $vgRealated = new VideoPosts();

                $vgRealated->post_id = $post_id;
                $vgRealated->video_gallery_id = $vgallery->id;
                $vgRealated->save();
            }

        }

        return redirect()->route('admin.videogalerias.index')->with('info', 'Videogaleria ' . $vgallery->name . ' editada con exito.' );
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
