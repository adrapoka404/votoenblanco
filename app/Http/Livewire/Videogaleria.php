<?php

namespace App\Http\Livewire;

use App\Models\VideoGallery;
use Livewire\Component;

class Videogaleria extends Component
{
    public function render()
    {
        $vgaleria       = VideoGallery::orderBy('created_at', 'desc')->first();
        $vgalerias      = VideoGallery::orderBy('id', 'desc')->offset(1)->limit(4)->get();


        return view('livewire.videogaleria', compact('vgaleria', 'vgalerias'));
    }
}
