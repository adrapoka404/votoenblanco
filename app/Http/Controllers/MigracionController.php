<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Postcategory;
use App\Models\PostDetails;
use App\Models\Postrelated;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use function PHPUnit\Framework\returnSelf;

class MigracionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ini_set('max_execution_time', 86400); // Extender a 1 dia
        $name_file      = "migracion_agosto_2021.txt";
        $st_date_start  = strtotime('2021-08-01');
        $st_date_end    = strtotime('2021-08-31');
        $daystrtotime   = 86400;
        $existen        = 0;
        $migradas        = 0;

        $days       = [];
        $relateds   = [];
        $cats       = [
            "local" => "local",
            "nacional" => "nacional",
            "global" => "internacional",
            "economía y finanzas" => "economía y finanzas",
            "deportes" => "deportes",
            "cultura" => "cultura",
            "estilo de vida" => "estilo de vida",
            "ciencia y tecnología" => "ciencia",
            "conociendo a..." => "conociendo a",
            "opinión" => "nuestras letras",
            "senado de la república" => "nacional",
            "cámara de diputados" => "nacional",
            "camino electoral" => "nacional",
            "vive fitnes" => "estilo de vida",
            "seguridad" => "nacional",
            "internacional" => "internacional",
            "salud" => "salud",
            "espectáculos" => "entretenimiento",
            "política" => "nacional",
            "dolar" => "economía y finanzas",
            "covid" => "salud",
            "tips de alimentación" => "salud",
            "comunidad" => "común unidad",
            "clima" => "nacional",
            "viral" => "estilo de vida",
            "estados" => "nacional",
            "tendencia" => "estilo de vida",
            "tendencias" => "estilo de vida",
            "entretenimiento" => "entretenimiento",
            "veracruz" => "nacional",
            "cdmx" => "nacional",
            "turismo" => "estilo de vida",
            "música" => "entretenimiento",
            "moda" => "estilo de vida",
        ];

        for ($dat = $st_date_start; $dat <= $st_date_end; $dat += $daystrtotime)
            $days[] = date('Y-m-d', $dat);


        $file = fopen("/home/imvdeme1/public_html/testvb/storage/logs/".$name_file, "w");

        foreach ($days as $day) {
            fwrite($file, "Comenzamos con " . $day . PHP_EOL);
            fwrite($file, "Siendo las " . date('Y:m:d H:m:s') . PHP_EOL);
            $posts = DB::connection('mysql_wp')
                ->table('wp_posts')
                ->where('post_type', 'post')
                ->where('post_status', 'publish')
                ->where('post_date', 'like', $day . '%')
                ->orderBy('id', 'ASC')
                ->get();
//return $posts;
          fwrite($file, "Se obtienen " . $posts->count() . PHP_EOL);
            $existen += $posts->count();
            foreach ($posts as &$post_wp) {
                fwrite($file, "---------------------------------------- START -----------------------------------" . PHP_EOL);
                fwrite($file, "Se inicia con la extraccion de elementos del post:  " . $post_wp->post_title . PHP_EOL);

                $post_wp->comments     = DB::connection('mysql_wp')->table('wp_comments')->where('comment_post_ID', $post_wp->ID)->get();
                $post_wp->views        = DB::connection('mysql_wp')->table('wp_yuzoviews')->where('post_id', $post_wp->ID)->get();

                $metas        = DB::connection('mysql_wp')->table('wp_postmeta')->where('post_id', $post_wp->ID)->get();
                foreach ($metas as $meta) {
                    if ($meta->meta_key == '_aioseop_opengraph_settings')
                        $post_wp->_aioseop_opengraph_settings = unserialize($meta->meta_value);

                    if ($meta->meta_key == '_wpas_mess')
                        $post_wp->_wpas_mess = $meta->meta_value;

                    if ($meta->meta_key == '_jetpack_related_posts_cache') {
                        $losrelacionados = unserialize($meta->meta_value);
                        foreach ($losrelacionados as $lrs) {
                            if (isset($lrs['payload'])) {
                                foreach ($lrs['payload'] as $lr) {
                                    $relateds[$post_wp->post_name][] = DB::connection('mysql_wp')->table('wp_posts')->where('ID', $lr['id'])->get();
                                }
                            }
                        }
                    }
                }

                $terms              = DB::connection('mysql_wp')->table('wp_term_relationships')->where('object_id', $post_wp->ID)->get();

                $categories = [];
                $tags       = [];

                foreach ($terms as &$term) {
                    $term->tags = DB::connection('mysql_wp')->table('wp_term_taxonomy')->where('term_taxonomy_id', $term->term_taxonomy_id)->get();

                    foreach ($term->tags as &$tag) {
                        $tag->description = DB::connection('mysql_wp')->table('wp_terms')->where('term_id', $tag->term_id)->get();
                    }
                }

                foreach ($terms as $term) {
                    foreach ($term->tags as $tag) {
                        //La taxonomy es una categoria, hay que iterar en y sacar las categorias
                        if ($tag->taxonomy == 'category') {
                            foreach ($tag->description as $cat) {
                                $categories[] = $cat->name;
                            }
                            //La taxonomy es una tag, hay que iterar en y sacar las tags
                        } else {
                            foreach ($tag->description as $tagl) {
                                $tags[] = $tagl->name;
                            }
                        }
                    }
                }

                $seos          = DB::connection('mysql_wp')->table('wp_aioseo_posts')->where('post_id', $post_wp->ID)->get();
                $images = [];

                if ($seos)
                    $images = $seos[0]->images;

                $images = json_decode($images);

                $post_wp->categories    = $categories;
                $post_wp->tags          = $tags;
                $post_wp->seos          = $seos;
                $post_wp->terms         = $terms;
//return $post_wp;
                if (isset($images[0])) {
                    $images = $images[0];

                    $post_wp->image = $images->{'image:loc'};
                    try {
                        $name = time() . rand(1, 5) . '.jpg';
                        $wp_imagen = file_get_contents($post_wp->image);
                        $new_image = '/home/imvdeme1/testvb/storage/app/public/posts/migration/' . $name;
                        fwrite($file, "Se copia imagen de " . $post_wp->image . " a la ruta " . $new_image . PHP_EOL);
                        $new_url = 'posts/migration/' . $name;
                        $save_in = file_put_contents($new_image, $wp_imagen);
                        $post_wp->image = $new_url;
                    } catch (Exception $ex) {
                        fwrite($file, "No se pudo obtener la imagen del servidor " . $ex->getMessage() . PHP_EOL);
                        $post_wp->image = 'img/default_post.png';
                    }
                } else
                    $post_wp->image = 'img/default_post.png';

                foreach ($post_wp->categories as &$category) {
                    $search = isset($cats[strtolower($category)]) ? $cats[strtolower($category)] : '';
                    if ($search != '') {
                        $theCategory    = Category::where('slug', str_replace(' ', '-', $cats[strtolower($category)]))->first();
                        fwrite($file, "Busco " . str_replace(' ', '-', strtolower($category)) . " para "  . $post_wp->post_title . PHP_EOL);
                        if ($theCategory) {
                            $category = $theCategory->nombre;
                            fwrite($file, " Se agregara con categoria " . $category . PHP_EOL);
                        } else
                            $category = "omite";
                    }
                }
                //$esta = '/home/imvdeme1/testvb/storage/app/public/migration/'.$name;
                //$vaPara = '/home/imvdeme1/public_html/testvb/storage/'.$name;
                //copy($esta, $vaPara);
                $post_wp->omitir = false;
                if (count($post_wp->categories) == 1 && $post_wp->categories[0] == 'omite') {
                    return $post_wp->categories;
                    //die();//$post_wp->omitir = true;
                }

                fwrite($file, "Inicia la creacion del post en la nueva plataforma siendo las " . date('Y-m-d H:m:s') . PHP_EOL);
                //Verificamos si hay una sola categoria y si se omite su creacion
                if (!$post_wp->omitir) {
                    $post_exist = Post::where('slug', $post_wp->post_name)->first();
                    if (!$post_exist) {
                        $post = new Post();

                        if (isset($post_wp->_wpas_mess))
                            $descripcionytextsocial     = $post_wp->_wpas_mess;
                        else
                            $descripcionytextsocial     = $post_wp->post_title;


                        $post->user_create          = 22;//ID del usuario editor de las notas
                        $post->title                = $post_wp->post_title;
                        $post->slug                 = $post_wp->post_name;
                        $post->description          =  $descripcionytextsocial;
                        $post->featured             = 1;
                        $post->social_text          = $descripcionytextsocial;
                        $desc                       = str_replace(' ', '-', $descripcionytextsocial);
                        $post->slug_description     = strtolower($desc);
                        $post->image_principal      = $post_wp->image;
                        $post->wp_id                = $post_wp->ID;
                        $post->created_at           = $post_wp->post_date;

                        try {
                            $post->save();

                            fwrite($file, "Inicia la creacion de detalles del post en la nueva plataforma siendo las " . date('Y-m-d H:m:s') . PHP_EOL);
                            $post_details = new PostDetails();

                            $post_details->post_id  = $post->id;
                            $post_details->body     = $post_wp->post_content;
                            $post_details->tags     = implode(',', $post_wp->tags);
                            $post_details->keywords = $post_wp->categories[0];

                            $post_details->save();

                            fwrite($file, "Inicia la realcion del post con las categorias en la nueva plataforma siendo las " . date('Y-m-d H:m:s') . PHP_EOL);
                            foreach ($post_wp->categories as $category) {
                                if ($category != 'omite') {
                                    $theCategory    = Category::where('slug', str_replace(' ', '-', strtolower($category)))->first();
                                    $defCategory    = Category::where('slug', 'nacional')->first();
                                    $postCategory   = new Postcategory();

                                    $postCategory->post_id = $post->id;

                                    if ($theCategory)
                                        $postCategory->category_id = $theCategory->id;
                                    else
                                        $postCategory->category_id = $defCategory->id;

                                    $postCategory->save();
                                }
                            }
                        } catch (Exception $ex) {
                            fwrite($file, "No se pudo subir el post " . $post_wp->post_title . " con id " . $post_wp->ID . " El error es: " . $ex->getMessage() . PHP_EOL);
                        }
                        fwrite($file, "Concluye la migracion de la nota " . $post_wp->post_title . " siendo las " . date('Y-m-d H:m:s') . PHP_EOL);
                        fwrite($file, "------------------------------------------------ END ------------------------------------------------------" . PHP_EOL . PHP_EOL);
                    } else
                        fwrite($file, "EL post " . $post_wp->post_title . " ya existe" . PHP_EOL);
                } else {
                    unset($relateds[$post_wp->post_name]);
                    fwrite($file, "Se omite la nota por categoria" . PHP_EOL);
                }
            }
            fwrite($file, "Concluye el proceso de migracion del dia " . $day . " siendo las " .  date('Y-m-d H:m:s') . PHP_EOL);
        }
        fwrite($file, "Concluye el proceso de migracion ahora vamos por las realciones de post siendo las " .  date('Y-m-d H:m:s') . PHP_EOL);

        foreach ($relateds as $related => $rels) {
            $post = Post::where('slug', $related)->first();
            foreach ($rels as $relA) {
                foreach ($relA as $rel) {

                    $postRelated = new Postrelated();
                    $pr = Post::where('wp_id', $rel->ID)->first();
                    if ($pr) {
                        $postRelated->post_id = $post->id;
                        $postRelated->related_id = $pr->id;

                        $postRelated->save();

                        $postRelated = new Postrelated();

                        $postRelated->post_id = $pr->id;
                        $postRelated->related_id = $post->id;

                        $postRelated->save();
                    }
                }
            }
        }

        fwrite($file, "Concluye el proceso de migracion siendo las " . date('Y-m-d H:m:s') . PHP_EOL);
        fclose($file);
        exit('ñ.ñ');
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
    public function show($id)
    {
        //
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
}
