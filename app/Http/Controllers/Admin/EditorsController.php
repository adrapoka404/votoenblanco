<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEditor;
use App\Models\Editor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class EditorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $headers = ['Nombre', 'Correo', 'Especialidad', 'Estado', 'Acciones'];
        $editors = Editor::orderBy('id', 'desc')->paginate(5);

        foreach($editors as &$editor) 
            $editor->user = User::find($editor->user_id);
        
        return view('admin.editors.index', compact('editors', 'headers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.editors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEditor $request)
    {
        $editor = $request->all()['editor'];

        $user = User::where('email', $editor['email'])->first();

        $editor['user_create'] = Auth::user()->id;

        if(!$user) {
          $user = new User();

          $user->name       = $editor['name'];
          $user->email      = $editor['email'];
          $user->password   = Hash::make($editor['name'].'_VotoEnBlanco');
          $user->save();
        } 

        $editor['user_id'] = $user->id;

        $editor = Editor::create($editor);

        return redirect()->route('admin.editors.index')->with('info', $editor->name . ' ha sido creado con exito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $editor         = Editor::find($id);
        $editor->status = 1;
        $editor->save();

        $editor->user   = User::find($editor->user_id);
        
        return redirect()->route('admin.editors.index')->with('info', $editor->user->name . ' ha sido habilitado con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $editor = Editor::find($id);
        $user = User::find($editor->user_id);

        $editor->name = $user->name;
        $editor->email = $user->email;

        return view('admin.editors.edit', compact('editor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreEditor $request, $id)
    {
        $editor = Editor::find($id);
        $upEditor = $request->all()['editor'];

        $user = User::where('email', $upEditor['email'])->first();

        if(!$user) {
          $user = new User();
          $user->name       = $upEditor['name'];
          $user->email      = $upEditor['email'];
          $user->password   = Hash::make($upEditor['name'].'_VotoEnBlanco');
          $user->save();
        } else {
            $user->name  = $upEditor['name'];
            $user->email = $upEditor['email'];

            $user->update();
        }
        
        $upEditor['user_id'] = $user->id;

        $editor->update($upEditor);

        return redirect()->route('admin.editors.index')->with('info', $editor->name . ' ha sido editado con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editor         = Editor::find($id);
        $editor->status = 0;
        $editor->save();

        $editor->user   = User::find($editor->user_id);
        
        return redirect()->route('admin.editors.index')->with('info', $editor->user->name . ' ha sido deshabilitado con exito');
    }
}
