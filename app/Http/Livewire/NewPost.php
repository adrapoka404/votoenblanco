<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;

class NewPost extends Component
{
    public $title = '';
    public $buscar;
    public $categories;
    public $posts;
    public $selected;
    public $selectedpost;
    public $picked;
    public $picked2;
    public $body = "html";

    public function mount(){
        $this->buscar       = "";
        $this->buscapost    = '';
        $this->categories   = [];
        $this->posts        = [];
        $this->selected     = [];
        $this->selectedpost = [];
        $this->selected2    = [];
        $this->picked       = true;
        $this->picked2      = true;
    }

    public function updatedBuscar(){
        $this->picked = false;
        $this->validate([
            "buscar" => "required|min:3",
        ], 
        [
            'buscar' => 'Campo de busqueda',
        ],
        [
            'buscar.required'   => 'Debe escribir algo para que se muestren resultados',
            'buscar.min'        => 'Debe escribir al menos 3 caracteres para que se muestren resultados',
        ]);

    
        $this->categories = Category::where('nombre',"like", "%" . trim($this->buscar) ."%")
                                ->get();
    }


    public function updatedBuscapost(){
        $this->picked2 = false;
        $this->validate([
            "buscapost" => "required|min:3",
        ], 
        [
            'buscapost' => 'Campo de relacionados',
        ],
        [
            'buscapost.required'   => 'Debe escribir algo para que se muestren resultados',
            'buscapost.min'        => 'Debe escribir al menos 3 caracteres para que se muestren resultados',
        ]);

    
        $this->posts = Post::where('title',"like", "%" . trim($this->buscapost) ."%")
                                ->get();
    }


    public function asignarCategory($category){
        $this->selected[$category] = Category::find($category);
        $this->buscar = '';
        $this->picked = true;
    }

    public function asignarPosts($post){
        $this->selectedpost[$post] = Post::find($post);
        $this->buscapost = '';
        $this->picked2 = true;
    }

    public function quitarCategory($category){
        unset($this->selected[$category]);
        $this->picked = true;
    }

    public function quitarPost($post){
        unset($this->selectedpost[$post]);
        $this->picked2 = true;
    }

    public function asignarPrimero(){
        $category = Category::where('nombre',"like", "%" . trim($this->buscar) ."%")->first();

        if($category)
            $this->buscar = $category->nombre;
        else
            $this->buscar = "...";

        $this->picked = true;
    }

    public function asignarPost(){
        $post = Post::where('title',"like", "%" . trim($this->buscapost) ."%")->first();

        if($post)
            $this->buscapost = $post->title;
        else
            $this->buscapost = "...";

        $this->picked2 = true;
    }


    public function render()
    {
        return view('livewire.new-post');
    }
}
