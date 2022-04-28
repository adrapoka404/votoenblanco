<?php

namespace App\Http\Livewire;

use App\Models\PostStatus;
use Livewire\Component;
use Livewire\WithPagination;

class Statusposts extends Component
{
    use WithPagination;

    public function render()
    {
        $statuses   = PostStatus::orderBy('name', 'asc')
                            ->paginate(5);
        $lists      = ['nombre','estado', 'acciones'];
        
        return view('livewire.statusposts', compact('statuses', 'lists'));
    }
}
