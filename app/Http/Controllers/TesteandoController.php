<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Fb;
use Illuminate\Http\Request;

class TesteandoController extends Controller
{
    //
    public function testfb(){
     
        $fb = new Fb();

        $fb->post_fb([]);
        die;
    }
}


