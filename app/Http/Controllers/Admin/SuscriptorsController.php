<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use App\Models\PostSaved;
use App\Models\Suscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SuscriptorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suscriptor = Auth::user();
        
        return view('admin.suscriptors.index', compact('suscriptor'));
    }

    public function saved()
    {
        $saveds = PostSaved::where('user_id', Auth::user()->id)->paginate(5);

        foreach($saveds as &$saved)
            $saved->post = Post::find($saved->post_id);
//return $saveds;
        return view('admin.suscriptors.saveds', compact('saveds'));
    }

    public function config()
    {
        $category     = Category::where('orden', 1)->where('nombre', 'Entrevistas')->first();

        $entrevistas = Category::where('patern_id', $category->id)->where('orden', 1)->get();

        $category     = Category::where('orden', 1)->where('nombre', 'Reportajes')->first();

        $reportajes = Category::where('patern_id', $category->id)->where('orden', 1)->get();

        $category     = Category::where('orden', 1)->where('nombre', 'Noticias')->first();

        $noticias = Category::where('patern_id', $category->id)->where('orden', 1)->get();

        $suscripciones = Suscription::where('user_id', Auth::user()->id)->get();

        foreach($entrevistas as &$entrevista){
            $entrevista->check = false;
            foreach($suscripciones as $sus){
                if($sus->category_id == $entrevista->id)
                    $entrevista->check = true;
            }
        }

        foreach($reportajes as &$reportaje){
            $reportaje->check = false;
            foreach($suscripciones as $sus){
                if($sus->category_id == $reportaje->id)
                    $reportaje->check = true;
            }
        }

        foreach($noticias as &$noticia){
            $noticia->check = false;
            foreach($suscripciones as $sus){
                if($sus->category_id == $noticia->id)
                    $noticia->check = true;
            }
        }
        //return $noticias;

        return view('admin.suscriptors.config', compact('reportajes', 'entrevistas', 'noticias'));
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
        return $request;
    }

    public function suscribeto(Request $request)
    {
        Suscription::where('user_id', Auth::user()->id)->delete();

        foreach($request->suscribeto as $category_id) {
            $suscribe = new Suscription();

            $suscribe->user_id = Auth::user()->id;
            $suscribe->category_id = $category_id;
            $suscribe->save();
        }

        return redirect()->route('admin.suscriptores.config')->with('info', 'Gracias por selecionar tus favoritas');
    }

    public function password(){
        return view('admin.suscriptors.password');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post_saved = PostSaved::find($id);
        
        $post_saved->delete();

        return redirect()->route('admin.suscriptores.guardadas')->with('info', 'La nota se ha quitado de sus guardados');
    }
}
