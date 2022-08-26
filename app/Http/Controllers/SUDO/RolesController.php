<?php

namespace App\Http\Controllers\SUDO;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Route;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('name', 'asc')->paginate(10);
        $headers = ['Nombre', 'Acciones'];
        return view('sudo.roles.index', compact('roles', 'headers'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('sudo.roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
        ]);
        $role = Role::create(['name' => $request->name]);
        
        return redirect()->route('sudo.roles.index')->with('info', 'Role ' . $role->name . ' creado correctamente');

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
        
        $role = Role::find($id);

        $permissions = Permission::all();
        /*$routeCollection = Route::getRoutes();

        foreach ($routeCollection as $value) {
            echo $value->getPath().'<br>';
        }
        return;
        */
        return view('sudo.roles.edit', compact('role', 'permissions'));
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

        $request->validate([
            'name' => 'required|min:3|max:50',
        ],
         [
            "name.required" => "El campo de nombre es requerido",
            "name.min"      => "El campo debe tener mas de 3 caracteres",
            "name.max"      => "El campo no debe tener mas de 100 caracteres",
        ]);

        $role = Role::find($id);

        $role->update(['name' => $request->name]);
        
        $role->permissions()->sync($request->permissions);
        

        return redirect()->route('sudo.roles.index')->with('info', 'Role ' . $role->name . ' editado correctamente');   
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
