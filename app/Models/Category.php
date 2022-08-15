<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    //Para los permitidos
    protected $fillable = ['nombre', 'slug','orden', 'visible', 'vistas', 'imagen', 'patern_id'];
    //para los protegidos
    protected $guarded = [''];

    public $headers = ['nombre', 'estado', 'acciones'];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
