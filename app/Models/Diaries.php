<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\GeneralDiaries;
use App\Models\Referer;

class Diaries extends Model
{
    use HasFactory;

    private $referer    = null;
    private $from       = null;
    private $agent      = null;
    private $url        = null;
    private $post       = null;
    private $category   = null;

    public function diary($headers, $post, $category){
        if(isset($headers['Referer']))
            $this->referer = $headers['Referer'];

        if(isset($headers['From']))
            $this->from = $headers['From'];
           
        if(isset($headers['User-Agent']))
            $this->agent = $headers['User-Agent'];

        $this->post         = $post;
        $this->category     = $category;
        $this->url          = url()->current();

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
        $reference->save();

        $from = From::where('from', $this->from)->first();

        if(is_null($from)){
            $from = new From();
            $from->from = $this->from;
        }
            
        $from->conteo += 1;
        $from->save();



        $agent = Agent::where('agent', $this->agent)->first();

        if(is_null($agent)){
            $agent = new Agent();
            $agent->agent = $this->agent;
        }
            
        $agent->conteo += 1;
        $agent->save();

        return;
    }
}
