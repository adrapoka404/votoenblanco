<?php

namespace App\Http\Livewire;

use App\Models\Post as ModelsPost;
use Livewire\Component;

class Post extends Component
{
    public function render()
    {
        $posts = ModelsPost::orderBy('title', 'asc')->paginate(10);

        return view('livewire.post', compact('posts'));
    }
}
