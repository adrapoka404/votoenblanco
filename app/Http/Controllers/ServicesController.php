<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServicesController extends Controller
{
    public function related(Request $request){
        $posts_response = [];
        $posts_response['Notas'] = Post::where('title', 'like', '%'.$request->search .'%')->get();
        
        $categories = Category::where('nombre', 'like', '%'.$request->search.'%')->get();

        foreach($categories as $category){
            $postByCategory = Postcategory::where('category_id', $category->id)->get();

            foreach($postByCategory as $pbc)
                $posts_response[$category->nombre][] = Post::find($pbc->post_id);
        }

        return $posts_response;
    }

    public function posts(Request $request){
        
        $posts_response=[];
        $posts = Post::where('title', 'like', '%'.$request->search .'%')->get();
        foreach($posts as $post)   
            $posts_response[$post->id] = $post;

        $categories = Category::where('nombre', 'like', '%'.$request->search.'%');

        foreach($categories as $category){
            $postByCategory = Postcategory::where('category_id', $category->id);

            foreach($postByCategory as $pbc)
                $posts_response[$pbc->id] = $pbc;
        }


        return $posts_response;
    }

    public function data(Request $request){
        $data_images    = [];
        $directory      = 'public';

        $url_images     = isset($request->directory) ? $request->directory : $directory.'/posts/' . date('Y_m');
        $carpetas       = Storage::directories($directory, true);
        $images         = Storage::allFiles($url_images);
        /*collect(Storage::allFiles($url_images))
                            ->filter(function ($file) {
                                return in_array($file->getExtension(), ['png', 'gif', 'jpg', 'jpeg', 'avg', 'gif']);
                            })
                            ->sortBy(function ($file) {
                                return $file->getCTime();
                            })
                            ->map(function ($file) {
                                return $file->getBaseName();
                            });
*/
    
        foreach($carpetas as $i => $iam){
            if($iam == 'public/profile-photos')
                $profiles = $i;
                if($iam == 'public/categories')
                $categories = $i;
        }
        
        unset($carpetas[$profiles]);
        unset($carpetas[$categories]);

        foreach($images as &$image){
            $i = str_replace('public/','', $image);
            $data_images[] = ['img_to'=> asset('storage/'.$i), 'img' => $i];
        }
        return ["success"=>true, "directories" => $carpetas, "images" => $data_images, 'in' => $url_images];
    }

    public function imagen_upload(Request $request){
        $this->validate(
            $request,
            [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                "image.required"    => "El archivo de imagen es requerido",
                "image.image"       => "El archivo no es una imagen",
                "image.mimes"       => "El archivo de imagen no tiene una extension valida. Extensiones permitidas: (jpeg,png,jpg,gif,svg)",
                "image.max"         => "La imagen no debe superar los 2MB",
            ]
        );
        
        $aqui = Storage::put($request->uploadIn,$request->file('image'));
        //$copy = Storage::copy($aqui, env('URI_STORAGE_PUB').$aqui);
        $aqui = str_replace('public/','', $aqui);
        $esta = '/home/imvdeme1/testvb/storage/app/public/'.$aqui;
        $vaPara = '/home/imvdeme1/public_html/testvb/storage/'.$aqui;
        copy($esta, $vaPara);
        

        
        return ["success"=>true, 'to' => asset('storage/'.$aqui), 'img' => $aqui, 'esta' => $esta, 'vaPara' => $vaPara];
    }

    public function sub_data($directory){
        $carpetas = Storage::directories('public/'.$directory);
        return $carpetas;
        return ["success"=>true];
    }

    public function data_imgs($directory){
        $carpetas = Storage::directories('public');
        return $carpetas;
        return ["success"=>true];
    }

    public function popup_images(){
        return view('admin.services.popup');
    }
}
