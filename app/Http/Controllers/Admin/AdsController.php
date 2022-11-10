<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
Use Illuminate\Support\Facades\File;
use Image;

class AdsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filter_name    = '';
        $filter_status  = '';
        $filter_start   = '';
        $filter_end     = '';

        $ads = Ad::paginate(15);
        
        foreach($ads as &$ad)
            $ad->sections = json_decode($ad->sections);
        
        //    return $ads;
        $headers = ['nombre', 'thumbnails','estado', 'inicia', 'finaliza', 'acciones'];
        return view('admin.ads.index', compact('ads', 'headers', 'filter_name', 'filter_status', 'filter_start', 'filter_end'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAdRequest $request)
    {
        
        $in         = 'public/ads';
        $thumbnails = storage_path().'/app/public/';
        
        $adds       = [];
        //return $request;
        //verificar si existe ruta para os thumbs
        if(!File::exists($thumbnails.'ads/thumbnails/'))
            File::makeDirectory($thumbnails.'ads/thumbnails/', 0755, true, true);
        
        if ($request->hasFile('add.local')) {

            $aqui = Storage::put($in, $request->file('add.local'));
            $aqui   = str_replace('public/', '', $aqui);
            
            //crear vista para admin-add-list y admin-add-edi            
            $local = $request->file('add.local');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_50x50.'.$local->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_150x150.'.$local->extension();
            $thumb_list = Image::make($local->path());
            $thumb_list->resize(150,150, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(50,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['local'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        if ($request->hasFile('add.hlateral')) {

            $aqui = Storage::put($in, $request->file('add.hlateral'));
            $aqui   = str_replace('public/', '', $aqui);
            
            //crear vista para admin-add-list y admin-add-edi            
            $hlateral = $request->file('add.hlateral');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_40x70.'.$hlateral->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_120x210.'.$hlateral->extension();
            $thumb_list = Image::make($hlateral->path());
            $thumb_list->resize(120,210, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(40,70, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['hlateral'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
            
        }

        if ($request->hasFile('add.category')) {

            $aqui = Storage::put($in, $request->file('add.category'));
            $aqui   = str_replace('public/', '', $aqui);

            //crear vista para admin-add-list y admin-add-edi            
            $category = $request->file('add.category');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_150x50.'.$category->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_300x70.'.$category->extension();
            $thumb_list = Image::make($category->path());
            $thumb_list->resize(300,70, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(150,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['category'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        if ($request->hasFile('add.postbody')) {

            $aqui = Storage::put($in, $request->file('add.postbody'));
            $aqui   = str_replace('public/', '', $aqui);

            //crear vista para admin-add-list y admin-add-edi            
            $postbody = $request->file('add.postbody');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_100x50.'.$postbody->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_350x100.'.$postbody->extension();
            $thumb_list = Image::make($postbody->path());
            $thumb_list->resize(350,100, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(100,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['postbody'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        if ($request->hasFile('add.postlateral')) {

            $aqui = Storage::put($in, $request->file('add.postlateral'));
            $aqui   = str_replace('public/', '', $aqui);
            
            //crear vista para admin-add-list y admin-add-edi            
            $postlateral = $request->file('add.postlateral');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_50x50.'.$postlateral->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_150x150.'.$postlateral->extension();
            $thumb_list = Image::make($postlateral->path());
            $thumb_list->resize(150,150, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(50,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['postlateral'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        $ad = new Ad();
        $ad->user_create =  Auth::user()->id;
        $ad->name =  $request->name;
        $ad->status =  $request->status;
        $ad->orden =  $request->orden;
        $ad->start =  $request->start;
        $ad->end =  $request->end;
        $ad->sections =  json_encode($adds);

        $ad->save();

        return redirect()->route('admin.anuncios.index')->with('info', 'Anuncio ' . $ad->name . ' creado con exito');
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
        $ad = Ad::find($id);

        $ad->sections = json_decode($ad->sections);

        return view('admin.ads.edit', compact('ad'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAdRequest $request, $id)
    {

        $in         = 'public/ads';
        $thumbnails = storage_path().'/app/public/';
        $adds       = [];
        //return $request;
        //verificar si existe ruta para os thumbs
        if(!File::exists($thumbnails.'ads/thumbnails/'))
            File::makeDirectory($thumbnails.'ads/thumbnails/', 0755, true, true);
        
        if ($request->hasFile('add.local')) {

            $aqui = Storage::put($in, $request->file('add.local'));
            $aqui   = str_replace('public/', '', $aqui);

            //crear vista para admin-add-list y admin-add-edi            
            $local = $request->file('add.local');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_50x50.'.$local->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_150x150.'.$local->extension();
            $thumb_list = Image::make($local->path());
            $thumb_list->resize(150,150, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(50,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['local'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        if ($request->hasFile('add.hlateral')) {

            $aqui = Storage::put($in, $request->file('add.hlateral'));
            $aqui   = str_replace('public/', '', $aqui);
            
            //crear vista para admin-add-list y admin-add-edi            
            $hlateral = $request->file('add.hlateral');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_40x70.'.$hlateral->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_120x210.'.$hlateral->extension();
            $thumb_list = Image::make($hlateral->path());
            $thumb_list->resize(120,210, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(40,70, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['hlateral'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
            
        }

        if ($request->hasFile('add.category')) {

            $aqui   = Storage::put($in, $request->file('add.category'));
            $aqui   = str_replace('public/', '', $aqui);
            //crear vista para admin-add-list y admin-add-edi            
            $category = $request->file('add.category');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_150x50.'.$category->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_300x70.'.$category->extension();
            $thumb_list = Image::make($category->path());
            $thumb_list->resize(300,70, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(150,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['category'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        if ($request->hasFile('add.postbody')) {

            $aqui = Storage::put($in, $request->file('add.postbody'));
            $aqui   = str_replace('public/', '', $aqui);

            //crear vista para admin-add-list y admin-add-edi            
            $postbody = $request->file('add.postbody');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_100x50.'.$postbody->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_350x100.'.$postbody->extension();
            $thumb_list = Image::make($postbody->path());
            $thumb_list->resize(350,100, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(100,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['postbody'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }

        if ($request->hasFile('add.postlateral')) {

            $aqui = Storage::put($in, $request->file('add.postlateral'));
            $aqui   = str_replace('public/', '', $aqui);
            //crear vista para admin-add-list y admin-add-edi            
            $postlateral = $request->file('add.postlateral');
            $url_thumb_list = 'ads/thumbnails/'.time().'_thumbnail_50x50.'.$postlateral->extension();
            $url_thumb_form = 'ads/thumbnails/'.time().'_thumbnail_150x150.'.$postlateral->extension();
            $thumb_list = Image::make($postlateral->path());
            $thumb_list->resize(150,150, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_form);

            $thumb_list->resize(50,50, function($const){
                $const->aspectRatio();
            })->save($thumbnails.$url_thumb_list);

            $adds['postlateral'] = ['origin' => $aqui, 'thumb_list' => $url_thumb_list, 'thumb_form' => $url_thumb_form];
        }
        
        $ad = Ad::find($id);
        $ad->name =  $request->name;
        $ad->status =  $request->status;
        $ad->orden =  $request->orden;
        $ad->start =  $request->start;
        $ad->end =  $request->end;
        $ad->sections =  json_encode($adds);
        $ad->save();

        return redirect()->route('admin.anuncios.index')->with('info', 'Anuncio ' . $ad->name . ' editado con exito');
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
