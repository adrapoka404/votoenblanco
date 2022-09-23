<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreConfig;
use App\Models\Config;
use Illuminate\Http\Request;

class ConfigsController extends Controller
{
    public function index()
    {
        $configs = Config::all();
        return view('admin.configs.index', compact('configs'));
    }

    public function store(StoreConfig $request)
    {

        foreach ($request->all() as $tag => $value) {
            if ($tag != '_token') {
                $conf = Config::where('tag', $tag)->first();
                $conf->value = $value;
                $conf->save();
            }
        }

        return redirect()->route('admin.configuraciones.index')->with('info', 'Variables de configuración editadas correctamente');
    }
}
