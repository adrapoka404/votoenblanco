<?php

namespace App\Http\Controllers\Admin;

use App\Charts\masleidas;
use App\Charts\MasLeidasChart;
use App\Http\Controllers\Controller;
use App\Models\Editor;
use App\Models\Post;
use App\Models\PostDiary;
use App\Models\PostReaction;
use App\Models\PostView;
use App\Models\Referer;
use App\Models\User;
use App\View\Components\coment;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use League\Csv\Writer;
use Illuminate\Support\Facades\DB;
use League\CommonMark\Reference\Reference;

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

        $referentes = new Referer();
        $referentes = $referentes->depurar();
        
        return view('admin.statistics.index', compact('masleidas', 'masleidos', 'masshare', 'massuperlikeadas', 'maslikeadas', 'masnolikeadas', 'referentes'));
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
        $headers = apache_request_headers();

        $back = $headers['Referer'];
        $dates = ["1 week" => "Una semana", "2 week" => "Dos semanas", "1 month" => "Un mes", "3 month" => "Tres meses"];
        $posts = Post::where('views', '>', 0)->orderBy('views', 'desc')->limit(10)->get();
        
        return view('admin.statistics.history_read', compact('back', 'dates', 'posts'));
    }

    public function data_masleidas(Request $request)
    {

        $fecha_actual = date("Y-m-d");
        $rango = date("Y-m-d",strtotime($fecha_actual."- $request->range")); 
        $fechaEmision = Carbon::parse($fecha_actual);
        $fechaExpiracion = Carbon::parse($rango);
        
        $diasDiferencia = $fechaExpiracion->diffInDays($fechaEmision);
        $history = [];
        for($i = 0; $i<=$diasDiferencia; $i++) {
            
            $nFecha = date("Y-m-d",strtotime($fecha_actual."- $i day")); 
            $query = "select count(*) as cuantos from `post_diaries` where `post_id` = $request->post_id and `created_at` LIKE '$nFecha%'";
            $diario = DB::select(DB::raw($query));// DB::select($query, []);

            array_unshift($history, [strval($nFecha), $diario[0]->cuantos]);
        }

        return $history;        
        
    }

    public function referentes(){
        $refers = new Referer();

        $referentes = $refers->detail();
        $nulos = $refers->nulos();
        
        return view('admin.statistics.references', compact('referentes', 'nulos'));
    }
}
