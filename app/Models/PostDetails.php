<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostDetails extends Model
{
    use HasFactory;

    //Para los permitidos
    protected $fillable = ['post_id', 'body','tags', 'keywords', 'posted'];
    //para los protegidos
    protected $guarded = [''];

    public $headers = ['nombre', 'estado', 'acciones'];
}
