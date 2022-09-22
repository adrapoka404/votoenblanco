<?php

namespace App\Http\Controllers;

use App\Models\Editor;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class EditoresController extends Controller
{
    public function show($id)
    {
        $editores = Editor::where('status', 1)->get();
        
        foreach($editores as &$editor) 
            $editor->user = User::find($editor->user_id);
        //return $editores;
        return view('guest.editores', compact('editores')); 
    }
}
