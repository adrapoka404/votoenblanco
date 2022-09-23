<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoriesRequest;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderBy('nombre', 'asc')->paginate(10);
        $headers    = ['nombre', 'estado', 'acciones'];
        return view('admin.categories.index', compact('headers', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::orderBy('id', 'asc')->get();
        return view('admin.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCategoriesRequest $request)
    {
        $nurl = Storage::put('public/categories',$request->file('imagen'));

        $request->imagen    = str_replace('public/','',$nurl);
        $request->slug      = Str::lower(Str::slug($request->nombre, '-'));
        
        $ncategory = Category::create($request->all());

        $ncategory->imagen = str_replace('public/','',$nurl);

        $ncategory->update();
        
        return redirect()->route('admin.categorias.index')->with('info', __('Categoría ' . $ncategory->nombre . ' creada'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        $categories = Category::orderBy('id', 'asc')->get();

        return view('admin.categories.edit', compact('category', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCategoriesRequest $request, $id)
    {
        $ncategory = Category::where('slug',$id)->first();
        
        if($request->hasFile('imagen')) {    
            $nurl = Storage::put('public/categories',$request->file('imagen'));
            $ncategory->imagen    = str_replace('public/' ,'',$nurl);
        }  
        

        $slug = Str::slug($request->nombre, '-');
        $ncategory->slug = Str::lower($slug);
        $ncategory->description = $request->description;
        $ncategory->description_video = $request->description_video;
        $ncategory->patern_id = $request->patern_id;

        $ncategory->update();
        return redirect()->route('admin.categorias.index')->with('info','Categoría ' . $ncategory->nombre . ' editada correctamente');
    }
}
