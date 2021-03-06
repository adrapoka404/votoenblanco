<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostComent extends Model
{
    use HasFactory;

    protected $fillable = ['post_id', 'user_id', 'name', 'email', 'comment'];
}
