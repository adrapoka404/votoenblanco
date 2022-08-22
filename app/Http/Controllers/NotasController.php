<?php

namespace App\Http\Controllers;

use App\Http\Livewire\Posts;
use App\Http\Requests\StoreComentsRequest;
use App\Models\Categories;
use App\Models\Category;
use App\Models\Editor;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\PostComent;
use App\Models\PostDetails;
use App\Models\PostReaction;
use App\Models\Postrelated;
use App\Models\PostSaved;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR use only single facades
use Artesaos\SEOTools\Facades\SEOTools;

class NotasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($who)
    {

        return view('guest.notas', compact('who')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        
        $post = Post::where('slug', $id)->first();

        //return $post;
        $id = $post->id;
        $post->views = $post->views + 1;
        $post->save();
        
        $post->details  = PostDetails::where('post_id', $id)->first();
        $relateds       = Postrelated::where('post_id', $id)->get();
        $categories     = Postcategory::where('post_id', $id)->get();
        $redactor       = User::find($post->user_create);
        $comments       = PostComent::where('post_id', $id)->where('status', 1)->get();
    
        if(!empty($relateds)){
    
            foreach($relateds as &$related) {
                $r = Post::find($related->related_id);
                $related->title = $r->title;
                $related->slug = $r->slug;
            }
        }

        if(!empty($categories)){
            foreach($categories as &$category) {
                $cat = Category::find($category->category_id);
                
                $category->name = $cat->nombre;
            }
        }

        $post->relateds     = $relateds;
        $post->categories   = $categories;
        $post->editor       = $redactor;
        $post->comments     = $comments;

        $post->saveme = false;
        $post->ireaction = false;
        
        $slikes = PostReaction::where('reaction', 1)->where('post_id', $post->id)->get();

        $post->slikes = $slikes->count();

        $likes = PostReaction::where('reaction', 2)->where('post_id', $post->id)->get();

        $post->likes = $likes->count();

        $nlikes = PostReaction::where('reaction', 3)->where('post_id', $post->id)->get();

        $post->nlikes = $nlikes->count();

        $user = $request->ip();

        $save = PostSaved::where('post_id', $post->id)->first();
        
        if($save)
            $post->saveme = true;
        
        if(Auth::user()) {
            $user = Auth::user()->id;
            //if($reaction = PostReaction::where('post_id', $post->id)->where('user_id', Auth::user()->id)->first())
            //    $post->likeme = $reaction->reaction;
        }
        
        if($meReaction = PostReaction::where('post_id', $post->id)->where('user_id', $user)->first())
            $post->ireaction = $meReaction->reaction;
                
        SEOMeta::setTitle($post->title);
        SEOMeta::setDescription($post->description);
        SEOMeta::setCanonical(route('notas.show', $post->id));

        OpenGraph::setDescription($post->description);
        OpenGraph::setTitle($post->title);
        OpenGraph::setUrl(route('notas.show', $post->id));
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle($post->title);
        TwitterCard::setSite('@websolutionstuff');

        JsonLd::setTitle($post->title);
        JsonLd::setDescription($post->description);
        JsonLd::addImage(asset('storage'.$post->image_principal));

        // OR use single only SEOTools

        SEOTools::setTitle($post->title);
        SEOTools::setDescription($post->description);
        SEOTools::opengraph()->setUrl('https://websolutionstuff.com/');
        SEOTools::setCanonical('https://websolutionstuff.com');
        SEOTools::opengraph()->addProperty('type', 'articles');
        SEOTools::twitter()->setSite('@websolutionstuff');
        SEOTools::jsonLd()->addImage('https://websolutionstuff.com/frontTheme/assets/images/logo.png');

        return view('guest.nota', compact('post')); 
    }

    public function editores($id)
    {
        //return $id;
        
        $editor = User::where('slug',$id)->first();
        
        $id = $editor->id;   
        
        $who = $editor->name;

        $posts = Post::where('user_create', $id )->orderBy('created_at', 'desc')->get();
        
        if($posts) {
           foreach($posts as &$post)
                $post->user = User::find($post->user_create);
        }

        $elEditor = Editor::where('user_id', $editor->id)->first();
        
        $elEditor->vistas = $elEditor->vistas + 1;
        $elEditor->save();
           // return $posts;
        return view('guest.notas', compact('editor','posts','who')); 
    }

    public function categorias( $request ) {
        $posts = [];
        $category = Category::where('slug', $request)->first();
        
        $who = $category->nombre;

        $postCategory = Postcategory::where('category_id', $category->id )->get();
        if($postCategory) {
            $ids = [];
            foreach($postCategory as $pc) 
                $ids[] = $pc->post_id;

                $posts = Post::whereIn('id', $ids)->orderBy('created_at', 'desc')->get();
                foreach($posts as &$post)
                    $post->user = User::find($post->user_create);
            }
        $category->vistas = $category->vistas + 1;
        $category->save();
            
        return view('guest.notas', compact('category', 'posts', 'who')); 
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function admin(){
        
    }
    public function reaction(Request $request){
        
        $post       = $request->all()['post_id'];
        $reaction   = $request->all()['reaction'];
        $img        = '';
        $time       = time();

        if(Auth::user())
            $user = Auth::user()->id;
        else
            $user = $request->ip();
        

        $exist = PostReaction::where('post_id', $post)->where('user_id', $user)->first();
        
        if(!$exist) {
            PostReaction::create(['user_id'=>$user, 'post_id'=>$post, 'reaction' => $reaction]);
            $img = 'On';
            $imgs = [
                'sLike'     => ($reaction == 1 ? asset('img/slike.png').'?'.$time : asset('img/slikeOn.png').'?'.$time),
                'like'      => ($reaction == 2 ? asset('img/like.png').'?'.$time : asset('img/likeOn.png').'?'.$time),
                'nLike'     => ($reaction == 3 ? asset('img/nolike.png').'?'.$time : asset('img/nolikeOn.png').'?'.$time),
            ];
        } else {
            $exist->delete();
            $imgs = [
                'sLike'     => asset('img/slikeOn.png').'?'.$time,
                'like'      => asset('img/likeOn.png').'?'.$time,
                'nLike'     => asset('img/nolikeOn.png').'?'.$time,
            ];
        }
            

        $likes = PostReaction::where('post_id', $post)->where('reaction', 2)->get();
        $slikes = PostReaction::where('post_id', $post)->where('reaction', 1)->get();
        $nlikes = PostReaction::where('post_id', $post)->where('reaction', 3)->get();
    
        return [
            'success'       => true, 
            'reactions'     => [
                            'slikes'    => $slikes->count(), 
                            'likes'     => $likes->count(), 
                            'nlikes'    => $nlikes->count()
            ],
            'imgs'          => $imgs
            ];    
    }

     public function share($id){
        return $id;
         $post = Post::find($id);
         
         $post->like = $post->like + 1;
 
         $post->save();
 
         return redirect()->route('nota.show', $id);
     }

    public function save(Request $request){
        if(Auth::user()){
            $post = $request->all()['save']['post_id'];
            $user = Auth::user()->id;

            $exist = PostSaved::where('post_id', $post)->where('user_id', $user)->first();
            
            if(!$exist){
                PostSaved::create(["user_id" => $user, "post_id" => $post]);
                $img = asset('img/guardadas.png');
                $label = 'Quitar de guardados';
            }else{
                $exist->delete();
                $img = asset('img/guardar.png');
                $label = 'Guardar';
            }
                
            
            return ['success'=>true, 'img' => $img, 'label' => $label];
        } else
            return ['error'=>true];
    }

    public function nosave(Request $request){
        $post = $request->all()['post_id'];
        $user = Auth::user()->id;
        
        $exist = PostSaved::where('post_id', $post)->where('user_id', $user)->delete();

        if($exist)
            return ['success'=>true];
        else
            return ['error'=>true];
     }

     public function coments(StoreComentsRequest $request){
        $coment = $request->all()['coment'];

        $user = User::where('email', $coment['email'])->first();

        if($user) 
            $coment['user_id'] = $user->id;
        
        //demomento
        $coment['status'] = 1;

        PostComent::create($coment);

        return ['success'=> true, 'msg' => '¡Exito! Gracias por darnos tu opinion'];
     }
}
