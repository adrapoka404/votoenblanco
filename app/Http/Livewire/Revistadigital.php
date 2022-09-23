<?php

namespace App\Http\Livewire;

use App\Models\Config;
use Livewire\Component;

class Revistadigital extends Component
{
    public function render()
    {
        $conf = Config::where('tag', 'iframe_revista')->first();
        $iframe_revista = $conf->value;
        return view('livewire.revistadigital', compact('iframe_revista'));
    }
}
