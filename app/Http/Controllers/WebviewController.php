<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR use only single facades
use Artesaos\SEOTools\Facades\SEOTools;

class WebviewController extends Controller
{
    public function vagabundario(){
        return "ADX";
    }

    public function entrevistas(){
        return view('guest/entrevistas');
    }

    public function reportajes(){
        return view('guest/reportajes');
    }

    public function noticias(){
        return view('guest/noticias');
    }

    public function aboutus(){
        return view('guest/aboutus');
    }

    public function privacy(){
        return view('guest/privacy');
    }

    public function team(){
        return view('guest/team');
    }

    public function welcome(){
        
        $locales      = [];
        $nacionales   = [];
        $deportes     = [];

        $destacada  = Post::where('featured', 1)->orderBy('id', 'desc')->first();
        
        $destacadas = Post::where('featured', 1)->orderBy('id', 'desc')->offset(1)->limit(4)->get();

        $categorias = Category::where('orden', 1)->whereIn('nombre', ['Deportes','Local','Nacional'])->get();
        
        

        foreach($categorias as $category) {
            $postCat = Postcategory::where('category_id', $category->id)->orderBy('created_at', 'desc')->limit(2)->get();
            
            if( strtolower  ($category->nombre) == 'deportes') {//14856 ** boo
                foreach($postCat as $post)
                    $deportes[] = Post::find($post->post_id);
            }

            if( strtolower  ($category->nombre) == 'local') {
                foreach($postCat as $post)
                    $locales[] = Post::find($post->post_id);
            }

            if( strtolower  ($category->nombre) == 'nacional') {
                foreach($postCat as $post)
                    $nacionales[] = Post::find($post->post_id);
            }

        }   
        //return $deportes;
        //return $local;
        //return $nacional;
        //return $destacada;
        //SEOMeta::setTitle('Un chingado titulo nuevo desde controller web');
        
        return view('welcome', compact('destacada', 'destacadas', 'locales', 'nacionales', 'deportes'));
    }
}
