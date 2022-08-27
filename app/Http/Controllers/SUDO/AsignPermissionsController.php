<?php

namespace App\Http\Controllers\SUDO;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class AsignPermissionsController extends Controller
{
    public function index(){
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        foreach($users as &$user) {
            $user->roles = $user->roles;
        }

        //return $users;
        $headers = ['Nombre','Correo','Role', 'Acciones'];

        return view('sudo.users.index', compact('users', 'headers'));
    }
    
    public function edit($id) {
        $user = User::find($id);
        $roles = Role::all();
        //return $user;
        return view('sudo.users.edit', compact('user', 'roles'));
    }

    public function update(Request $request) {
        $user = User::find($request->user_id);
        
        if(isset($request->roles ))
            $user->roles()->sync($request->roles);
        
        return  redirect()->route('sudo.asign.permissions.index')->with('info', 'Roles asignados a ' . $user->name . ' de forma correcta');
    }
}
