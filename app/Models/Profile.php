<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    //Para los permitidos
    protected $fillable = ['user_id','position', 'signature','email', 'profession', 'speciality', 'semblance', 'birthday', 'mobile', 'fb', 'tw', 'ty','tt', 'personal'];
    //para los protegidos
    protected $guarded = [''];

    public $headers = [];
}
