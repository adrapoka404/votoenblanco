<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostStatus extends Model
{
    use HasFactory;

    
    //Para los permitidos
    protected $fillable = ['name', 'description','status'];
    //para los protegidos
    protected $guarded = [''];

    public $headers = ['nombre', 'estado', 'acciones'];
}
