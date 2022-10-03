<?php

namespace App\Http\Controllers;

use App\Models\Ad;
use App\Models\Category;
use App\Models\DailyStatistic;
use App\Models\Editor;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\User;
use App\Models\VideoGallery;
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
        $category = Category::where('nombre', 'entrevistas')->first();
        $categories = Category::where('patern_id', $category->id)->orderBy('nombre', 'asc')->get();

        return view('guest/entrevistas', compact('categories'));
    }

    public function reportajes(){

        $category = Category::where('nombre', 'reportajes')->first();
        $categories = Category::where('patern_id', $category->id)->orderBy('nombre', 'asc')->get();
        
        return view('guest/reportajes', compact('categories'));
    }

    public function noticias(){
        $category = Category::where('nombre', 'noticias')->first();
        $categories = Category::where('patern_id', $category->id)->orderBy('nombre', 'asc')->get();
        $categorias =  [];
        
        foreach($categories as $category) {
            $postByCate = Postcategory::where('category_id', $category->id)->offset(0)->limit(2)->orderBy('created_at','desc')->get();
            
            foreach($postByCate as $pbc){
                $tpost = Post::where('status', 4)->where('id', $pbc->post_id)->first();  
                if($tpost)
                    $categorias[$pbc->post_id] = Post::where('status', 4)->where('id',$pbc->post_id)->first();  
            }
        }
        foreach($categorias as &$cat){
            $cat->user = User::find($cat->user_create);
        }
        
        return view('guest/noticias', compact('categorias'));
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

    public function terms(){
        return view('guest/terms');
    }

    public function welcome() {
        
        $locales      = [];
        $nacionales   = [];
        $deportes     = [];

        $destacada      = Post::where('featured', 1)->where('status', 4)->orderBy('created_at', 'desc')->first();
        $destacadas     = Post::where('featured', 1)->where('status', 4)->orderBy('id', 'desc')->offset(1)->limit(4)->get();
        
        $categorias     = Category::where('orden', 1)->whereIn('nombre', ['Deportes','Local','Nacional'])->get();
        
        $destacada->redactor = User::find($destacada->user_create);

        foreach($destacadas as &$desta){
            $desta->redactor = User::find($desta->user_create);
        }
        
        foreach($categorias as $category) {
            $postCat = Postcategory::where('category_id', $category->id)->orderBy('created_at', 'desc')->limit(2)->get();
            
            if( strtolower  ($category->nombre) == 'deportes') {
                foreach($postCat as $post)
                    $deportes[] = Post::where('status', 4)->where('id',$post->post_id)->first();
            }

            if( strtolower  ($category->nombre) == 'local') {
                foreach($postCat as $post)
                    $locales[] = Post::where('status', 4)->where('id',$post->post_id)->first();
            }

            if( strtolower  ($category->nombre) == 'nacional') {
                foreach($postCat as $post)
                    $nacionales[] = Post::where('status', 4)->where('id',$post->post_id)->first();
            }

        }   
        
        $editors = Editor::where('status', 1)->orderBy('specialty', 'asc')->get();

        foreach ($editors as &$editor)
            $editor->user = User::find($editor->user_id);

        $home_local     = null;
        $ads = Ad::where('status', 1)->get();

        foreach($ads as $ad) {
            $sections = unserialize($ad->sections);
                if(in_array('home_local', $sections))
                $home_local[] = $ad;
        }
        
        $headers = apache_request_headers();
           
        $diario = new DailyStatistic();
        
        $diario->url    = url()->current();
        $diario->reference = serialize($headers);

        $diario->save();

        return view('welcome', compact('destacada', 'destacadas', 'locales', 'nacionales', 'deportes', 'editors','home_local'));
    }
}
