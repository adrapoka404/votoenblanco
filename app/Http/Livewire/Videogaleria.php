<?php

namespace App\Http\Livewire;

use App\Models\Ad;
use App\Models\VideoGallery;
use Livewire\Component;

class Videogaleria extends Component
{
    public function render()
    {
        $vgaleria       = VideoGallery::orderBy('created_at', 'desc')->first();
        $vgalerias      = VideoGallery::orderBy('id', 'desc')->offset(1)->limit(4)->get();

        $home_lateral    = null;
        $ads = Ad::where('status', 1)->orderBy('orden', 'asc')->get();

        foreach($ads as &$ad) {
            $ad->sections = json_decode($ad->sections);
                if(isset($ad->sections->hlateral))
                $home_lateral[] = $ad;
        }

        return view('livewire.videogaleria', compact('vgaleria', 'vgalerias', 'home_lateral'));
    }
}
