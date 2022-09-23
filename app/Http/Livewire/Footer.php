<?php

namespace App\Http\Livewire;

use App\Models\Config;
use Livewire\Component;

class Footer extends Component
{
    public function render()
    {
        $link_ig = Config::where('tag', 'link_ig')->first()->value;
        $link_fb = Config::where('tag', 'link_fb')->first()->value;
        $link_tw = Config::where('tag', 'link_tw')->first()->value;
        $link_tt = Config::where('tag', 'link_tt')->first()->value;
        $link_yt = Config::where('tag', 'link_yt')->first()->value;
        $link_cw = Config::where('tag', 'contact_wts')->first()->value;

        return view('livewire.footer', compact('link_ig','link_fb','link_tw','link_tt','link_yt','link_cw'));
    }
}
