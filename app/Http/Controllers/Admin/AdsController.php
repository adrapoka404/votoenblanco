<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdRequest;
use App\Models\Ad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $headers = ['nombre', 'estado', 'inicia', 'finaliza', 'acciones'];
        return view('admin.ads.index', compact('ads', 'headers', 'filter_name', 'filter_status', 'filter_start' ,'filter_end'));
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
        $ad = new Ad();
        $ad->user_create =  Auth::user()->id;
        $ad->name =  $request->name;
        $ad->body =  $request->body;
        $ad->status =  $request->status;
        $ad->orden =  $request->orden;
        $ad->start =  $request->start;
        $ad->end =  $request->end;
        $ad->sections =  serialize($request->sections);
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

        $ad->sections = unserialize($ad->sections);
        
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
        $ad = Ad::find($id);
        $ad->name =  $request->name;
        $ad->body =  $request->body;
        $ad->status =  $request->status;
        $ad->orden =  $request->orden;
        $ad->start =  $request->start;
        $ad->end =  $request->end;
        $ad->sections =  serialize($request->sections);
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
