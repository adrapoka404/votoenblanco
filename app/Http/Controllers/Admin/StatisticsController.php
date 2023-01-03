<?php

namespace App\Http\Controllers\Admin;

use App\Charts\masleidas;
use App\Charts\MasLeidasChart;
use App\Http\Controllers\Controller;
use App\Models\DailyStatistic;
use App\Models\Editor;
use App\Models\Post;
use App\Models\PostDiary;
use App\Models\PostReaction;
use App\Models\PostView;
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
        $masleidas   = Post::where('status', 4)->orderBy('views', 'desc')->offset(0)->limit(10)->get();
        

        $masleidos   = Editor::where('status', 1)->orderBy('vistas', 'desc')->get();

        foreach($masleidos as &$masleido)
            $masleido->user = User::find($masleido->user_id);

        $masshare   = Post::where('status', 4)->where('shareds', '>', 0)->orderBy('shareds', 'desc')->first();

        $posts      = Post::where('status', 4)->get();

        $intSLike   = 0;
        $intLike    = 0;
        $intNLike   = 0;

        $masslike   = [];
        $maslike    = [];
        $masnlike   = [];

        $massuperlikeadas = DB::table('post_reactions')
            ->select(DB::raw('(select title from posts where id = post_id) as post, count(post_id) as reactions'))
            ->where('reaction', '=', 1)
            ->groupBy('post_id')
            ->orderBy('reactions', 'desc')
            ->get();

       
        $maslikeadas = DB::table('post_reactions')
            ->select(DB::raw('(select title from posts where id = post_id) as post, count(post_id) as reactions'))
            ->where('reaction', '=', 2)
            ->groupBy('post_id')
            ->orderBy('reactions', 'desc')
            ->get();

        $masnolikeadas = DB::table('post_reactions')
            ->select(DB::raw('(select title from posts where id = post_id) as post, count(post_id) as reactions'))
            ->where('reaction', '=', 3)
            ->groupBy('post_id')
            ->orderBy('reactions', 'desc')
            ->get();
        return view('admin.statistics.index', compact('masleidas', 'masleidos', 'masshare', 'massuperlikeadas', 'maslikeadas', 'masnolikeadas'));
    }

    public function masleidas()
    {
        $references = [];
        
        $posts = Post::where('views', '>', 0)->orderBy('views', 'desc')->paginate(10);
        
        $mores_visit    = [];
        $froms          = [];
        $referers       = [];
        $agents         = [];
        
        foreach ($posts as $post) 
            $estadisticas = PostDiary::where('post_id', $post->id)->get();
        
        foreach ($estadisticas as $estadistica) {
                if (array_key_exists($estadistica->referer, $referers))
                    $referers[$estadistica->referer] += 1;
                else
                    $referers[$estadistica->referer] = 1;

                if (array_key_exists($estadistica->from, $froms))
                    $estadistica->from += 1;
                else
                    $estadistica->from = 1;

                if (array_key_exists($estadistica->agent, $agents))
                    $agents[$estadistica->agent] += 1;
                else
                    $agents[$estadistica->agent] = 1;
        }

        return view('admin.statistics.chart', compact('posts', 'froms', 'referers', 'agents'));
    }

    public function masleidos()
    {
        $masleidos   = Editor::where('status', 1)->orderBy('vistas', 'desc')->paginate(10);

        foreach ($masleidos as $indx => &$ml)
            $ml->user = User::find($ml->user_id);

        //return $masleidos;
        return view('admin.statistics.masleidos', compact('masleidos'));
    }

    public function masslikeadas()
    {

        $masslikeadas = DB::table('post_reactions')
            ->select(DB::raw('post_id, count(post_id) as reactions'))
            ->where('reaction', '=', 1)
            ->groupBy('post_id')
            ->orderBy('reactions', 'desc')
            ->get();


        foreach ($masslikeadas as $indx => &$msl)
            $msl->post = Post::find($msl->post_id);

        $title = __("Notas con más 'me encanta'");

        //return $masslikeadas;
        return view('admin.statistics.masslikeadas', compact('masslikeadas', 'title'));
    }

    public function maslikeadas()
    {
        $maslikeadas = DB::table('post_reactions')
            ->select(DB::raw('post_id, count(post_id) as reactions'))
            ->where('reaction', '=', 2)
            ->groupBy('post_id')
            ->orderBy('reactions', 'desc')
            ->get();


        foreach ($maslikeadas as $indx => &$ml)
            $ml->post = Post::find($ml->post_id);

        $title = __("Notas con más 'me gusta'");

        //return $masslikeadas;
        return view('admin.statistics.maslikeadas', compact('maslikeadas', 'title'));
    }

    public function masnlikeadas()
    {
        $masnlikeadas = DB::table('post_reactions')
            ->select(DB::raw('post_id, count(post_id) as reactions'))
            ->where('reaction', '=', 3)
            ->groupBy('post_id')
            ->orderBy('reactions', 'desc')
            ->get();


        foreach ($masnlikeadas as $indx => &$mnl)
            $mnl->post = Post::find($mnl->post_id);

        $title = __("Notas con más 'me enoja'");

        //return $masslikeadas;
        return view('admin.statistics.masnlikeadas', compact('masnlikeadas', 'title'));
    }
    public function masleidasexport()
    {
        $records = [
            [1, 2, 3],
            ['foo', 'bar', 'baz'],
            ['john', 'doe', 'john.doe@example.com'],
        ];

        $writer = Writer::createFromPath(Storage('files/exports/masleidas_' . date('Y_m_d') . '.csv'), 'w+');
        $writer->insertOne(['john', 'doe', 'john.doe@example.com']);
        $writer->insertAll($records); //using an array
        $writer->insertAll(new ArrayIterator($records));
    }

    public function masleidosexport()
    {
        return "Esportar mas leidos";
    }

    public function history($post_id)
    {
        
        
        $headers = apache_request_headers();

        $history = PostReaction::where('post_id', $post_id)->orderBy('created_at', 'desc')->get();
        $post = Post::find($post_id);
        $back = $headers['Referer'];

        return view('admin.statistics.history', compact('history', 'post', 'back'));
    }

    public function history_read($post_id=null)
    {
        
        $posts = Post::where('views', '>', 0)->orderBy('views', 'desc')->paginate(10);
        
        $headers = apache_request_headers();

        $back = $headers['Referer'];
        
        return view('admin.statistics.history_read', compact('back', 'posts'));
    }

    public function data_masleidas()
    {
        $posts = Post::where('views', '>', 0)->orderBy('views', 'desc')->paginate(10);
        
        $fecha_actual = date("Y-m-d");
        $history=[];
        foreach($posts as $post){
            for($i=30; $i>=0; $i--){
                $nDay = date("Y-m-d",strtotime($fecha_actual."- $i days"));  

                $estads = DB::table('post_diaries')
                ->select(DB::raw("count(*) as visitas"))
                ->where('post_id', '=', $post->id)
                ->where('created_at', 'LIKE',$nDay."%")
                ->first();
                
                 $history['datasset'][$post->id][$nDay] = $estads->visitas;
            }    
            $history['culumns'][$post->id] = $post->title;
        }

        $seteados = [];

        foreach($history['datasset'] as $post => $hs){
            foreach($hs as $d => $h)
            $seteados[$d][] = $history['datasset'][$post][$d];
        }

        $newDatasset = [];

        foreach($seteados as $date => $set){
            array_unshift($set, $date);
            $newDatasset[] = $set;
        }
        
        $history['seteados'] = $newDatasset;

        return $history;
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
