<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Editor;
use App\Models\User;
use Livewire\Component;

class Header extends Component
{
    public function render()
    {
        $reportajes = [];
        $entrevistas = [];
        $noticias = [];

        $editors = Editor::where('status', 1)->orderBy('specialty', 'asc')->get();

        foreach ($editors as &$editor)
            $editor->user = User::find($editor->user_id);

        //menu Reportajes
        $creportajes = Category::where('nombre', 'reportajes')->first();

        if ($creportajes)
            $reportajes = Category::where('patern_id', $creportajes->id)->orderBy('nombre', 'asc')->get();

        $centrevistas = Category::where('nombre', 'entrevistas')->first();

        if ($centrevistas)
            $entrevistas = Category::where('patern_id', $centrevistas->id)->orderBy('nombre', 'asc')->get();

        $cnoticias = Category::where('nombre', 'noticias')->first();

        if ($cnoticias)
            $noticias = Category::where('patern_id', $cnoticias->id)->orderBy('nombre', 'asc')->get();


        return view('livewire.header', compact('editors', 'reportajes', 'entrevistas', 'noticias'));
    }
}
