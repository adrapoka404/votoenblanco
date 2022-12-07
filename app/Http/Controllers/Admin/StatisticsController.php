<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyStatistic;
use App\Models\Editor;
use App\Models\Post;
use App\Models\PostReaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use League\Csv\Writer;
use Illuminate\Support\Facades\DB;

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
        
        $masshare   = Post::where('status', 4)->where('shareds', '>', 0)->orderBy('shareds', 'desc')->first();
        
        $posts      = Post::where('status', 4)->get();
        
        $intSLike   = 0;
        $intLike    = 0;
        $intNLike   = 0;

        $masslike   = [];
        $maslike    = [];
        $masnlike   = [];

        $masslikeadas = DB::table('post_reactions')
             ->select(DB::raw('post_id, count(post_id) as reactions'))
             ->where('reaction', '=', 1)
             ->groupBy('post_id')
             ->orderBy('reactions', 'desc')
             ->get();

        $masslike = Post::find($masslikeadas[0]->post_id);
        $masslike->slikes = $masslikeadas[0]->reactions;

        $maslikeadas = DB::table('post_reactions')
             ->select(DB::raw('post_id, count(post_id) as reactions'))
             ->where('reaction', '=', 2)
             ->groupBy('post_id')
             ->orderBy('reactions', 'desc')
             ->get();

        $maslike = Post::find($maslikeadas[0]->post_id);
        $maslike->likes = $maslikeadas[0]->reactions;


        $masnlikeadas = DB::table('post_reactions')
             ->select(DB::raw('post_id, count(post_id) as reactions'))
             ->where('reaction', '=', 3)
             ->groupBy('post_id')
             ->orderBy('reactions', 'desc')
             ->get();


        $masnlike = Post::find($masnlikeadas[0]->post_id);
        $masnlike->nlikes = $masnlikeadas[0]->reactions;

        /*
        foreach($posts as $post){
            $slikes = PostReaction::where('post_id', $post->id)->where('reaction', 1)->orderBy('id', 'asc')->get();
            
            if(isset($slikes) && $slikes->count() > $intSLike){
                $post->slikes = $slikes->count();
                $masslike = $post;
            }

            $likes = PostReaction::where('post_id', $post->id)->where('reaction', 2)->orderBy('id', 'asc')->get();
            
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
        */
        return view('admin.statistics.index', compact('masleida', 'masleido', 'masshare', 'masslike', 'maslike', 'masnlike'));
    }

    public function masleidas(){
       $masleidas = Post::where('status', 4)->orderBy('views', 'desc')->paginate(20);
       
       return view('admin.statistics.chart', compact('masleidas'));
    }

    public function masleidos(){
        $masleidos   = Editor::where('status', 1)->orderBy('vistas', 'desc')->paginate(10);

        foreach($masleidos as $indx => &$ml)
            $ml->user = User::find($ml->user_id);
        
            //return $masleidos;
        return view('admin.statistics.masleidos', compact('masleidos'));
     }

     public function masslikeadas(){
  
        $masslikeadas = DB::table('post_reactions')
             ->select(DB::raw('post_id, count(post_id) as reactions'))
             ->where('reaction', '=', 1)
             ->groupBy('post_id')
             ->orderBy('reactions', 'desc')
             ->get();


        foreach($masslikeadas as $indx => &$msl)
            $msl->post = Post::find($msl->post_id);
        
            $title = __("Notas con más 'me encanta'");

        //return $masslikeadas;
        return view('admin.statistics.masslikeadas', compact('masslikeadas', 'title'));
     }

     public function maslikeadas(){
        $maslikeadas = DB::table('post_reactions')
        ->select(DB::raw('post_id, count(post_id) as reactions'))
        ->where('reaction', '=', 2)
        ->groupBy('post_id')
        ->orderBy('reactions', 'desc')
        ->get();


   foreach($maslikeadas as $indx => &$ml)
       $ml->post = Post::find($ml->post_id);
   
       $title = __("Notas con más 'me gusta'");

   //return $masslikeadas;
   return view('admin.statistics.maslikeadas', compact('maslikeadas', 'title'));
     }

     public function masnlikeadas(){
        $masnlikeadas = DB::table('post_reactions')
        ->select(DB::raw('post_id, count(post_id) as reactions'))
        ->where('reaction', '=', 3)
        ->groupBy('post_id')
        ->orderBy('reactions', 'desc')
        ->get();


   foreach($masnlikeadas as $indx => &$mnl)
       $mnl->post = Post::find($mnl->post_id);
   
       $title = __("Notas con más 'me enoja'");

   //return $masslikeadas;
   return view('admin.statistics.masnlikeadas', compact('masnlikeadas', 'title'));
     }
     public function masleidasexport(){
        $records = [
            [1, 2, 3],
            ['foo', 'bar', 'baz'],
            ['john', 'doe', 'john.doe@example.com'],
        ];
        
        $writer = Writer::createFromPath(Storage('files/exports/masleidas_'.date('Y_m_d').'.csv'), 'w+');
        $writer->insertOne(['john', 'doe', 'john.doe@example.com']);
        $writer->insertAll($records); //using an array
        $writer->insertAll(new ArrayIterator($records));
     }
 
     public function masleidosexport(){
        return "Esportar mas leidos";
     }

    public function history($post_id){
        $headers = apache_request_headers();
        
        $history = PostReaction::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        $post = Post::find($post_id);
        $back = $headers['Referer'];

        return view('admin.statistics.history', compact('history','post', 'back'));
    }

    public function history_read($post_id){
        $headers = apache_request_headers();
        
        $history = DailyStatistic::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        $post = Post::find($post_id);
        $back = $headers['Referer'];

        return view('admin.statistics.history_read', compact('history','post', 'back'));
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
