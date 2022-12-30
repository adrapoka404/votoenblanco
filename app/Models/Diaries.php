<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GeneralDiaries;
use App\Models\Referer;

class Diaries extends Model
{
    use HasFactory;

    private $referer        = null;
    private $from           = null;
    private $agent          = null;
    private $url            = null;
    private $post           = null;
    private $exist          = null;
    
    private $updated_at     = null;


    public function diary($headers, $post, $category, $exist = null){
        if(isset($headers['Referer']))
            $this->referer = $headers['Referer'];

        if(isset($headers['From']))
            $this->from = $headers['From'];
           
        if(isset($headers['User-Agent']))
            $this->agent = $headers['User-Agent'];

        $this->post         = $post;
        $this->category     = $category;

        $this->url          = url()->current();

        
        if($exist != null){
            $this->url          = $exist->url;
            $this->exist        = $exist;
        }

        if($post == null && $category == null)
            $this->general();
        elseif($post != null && $category == null)
            $this->post();
        elseif($post == null && $category != null)
            $this->category();
        else
            return;
        return;
    }

    private function general(){
        
        $diario = new GeneralDiaries();

        $diario->url        = $this->url;
        $diario->referer    = $this->referer;
        $diario->from       = $this->from;
        $diario->agent      = $this->agent;
        
        if($this->exist != null) {
            $diario->created_at = $this->exist->created_at;
            $diario->updated_at = $this->exist->updated_at;
        }

        $diario->save();

        $this->references();
        return;
    }

    private function post(){
        $diario = new PostDiary();
        
        $diario->post_id    = $this->post->id;
        $diario->post       = $this->post->title;
        $diario->url        = $this->url;
        $diario->referer    = $this->referer;
        $diario->from       = $this->from;
        $diario->agent      = $this->agent;
        
        if($this->exist != null) {
            $diario->created_at = $this->exist->created_at;
            $diario->updated_at = $this->exist->updated_at;
        }

        $diario->save();

        $this->references();
        return;
    }

    private function category(){
     $diario = new CategoryDiary();

        $diario->category_id    = $this->category->id;
        $diario->category       = $this->category->nombre;
        $diario->url            = $this->url;
        $diario->referer        = $this->referer;
        $diario->from           = $this->from;
        $diario->agent          = $this->agent;
        
        if($this->exist != null) {
            $diario->created_at = $this->exist->created_at;
            $diario->updated_at = $this->exist->updated_at;
        }
        
        $diario->save();

        $this->references();
        return;
    }

    private function references(){
        $reference = Referer::where('referer', $this->referer)->first();

        if(is_null($reference)){
            $reference = new Referer();
            $reference->referer = $this->referer;
        }
            
        $reference->conteo += 1;
        
        if($this->exist != null) {
            $reference->created_at = $this->exist->created_at;
            $reference->updated_at = $this->exist->updated_at;
        }

        $reference->save();

        $from = From::where('from', $this->from)->first();

        if(is_null($from)){
            $from = new From();
            $from->from = $this->from;
        }
            
        $from->conteo += 1;

        if($this->exist != null) {
            $from->created_at = $this->exist->created_at;
            $from->updated_at = $this->exist->updated_at;
        }
        
        $from->save();



        $agent = Agent::where('agent', $this->agent)->first();

        if(is_null($agent)){
            $agent = new Agent();
            $agent->agent = $this->agent;
        }
            
        $agent->conteo += 1;
        
        if($this->exist != null) {
            $agent->created_at = $this->exist->created_at;
            $agent->updated_at = $this->exist->updated_at;
        }

        $agent->save();

        return;
    }
}
