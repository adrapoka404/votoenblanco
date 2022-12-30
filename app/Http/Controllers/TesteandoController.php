<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\DailyStatistic;
use App\Models\Diaries;
use App\Models\Fb;
use App\Models\Post;
use Illuminate\Http\Request;

class TesteandoController extends Controller
{
    //
    public function testfb(){
     
        $fb = new Fb();

        $fb->post_fb([]);
        die;
    }

    public function daily_to_diary(){
        $diarios= DailyStatistic::orderBy('id', 'asc')->offset(0)->limit(10)->get();
        foreach($diarios as $diario){
            $headers = unserialize($diario->reference);
            $diary = new Diaries();
            $post = null;
            $category = null;

            if($diario->post_id != null)
                $post = Post::find($diario->post_id);
            
            if($diario->category_id != null)
                $category = Category::find($diario->category_id);

            $diary->diary($headers, $post, $category, $diario);

            $diario->delete();
        }
        return "ñ_ñ";        
    }
}


