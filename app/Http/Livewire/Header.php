<?php

namespace App\Http\Livewire;

use App\Models\Editor;
use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $editors = Editor::where('status', 1)->orderBy('specialty', 'asc')->get();
        
        foreach($editors as &$editor)
            $editor->user = User::find($editor->user_id);
            
        return view('livewire.header', compact('editors'));
        
    }
}
