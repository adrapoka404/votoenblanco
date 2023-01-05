<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referer extends Model
{
    use HasFactory;

    public $referers        = [
        'facebook'      => [],
        'google'        => [],
        'votoenblanco'  => [],
        'testvb'        => [],
        'otros'         => [],
        'nulo'          => []
    ];
    private $referentes     = [];
    private $fb             = 'facebook.com';
    private $mfb            = 'm.facebook.com';
    private $gg             = 'google.com';
    private $vb             = 'votoenblanco.com.mx';
    private $vbc            = 'votoenblanco.com.mx/notas.category.';
    private $vbe            = 'votoenblanco.com.mx/notas.editores.';
    private $vbn            = 'votoenblanco.com.mx/notas/';
    private $vbt            = 'votoenblanco.test';
    private $tt             = 0;

    private function get_all()
    {
        $this->referentes =  Referer::all();
    }
    public function depurar()
    {
        $referers = ['facebook' => 0, 'google' => 0, 'votoenblanco' => 0, 'testvb' => 0, 'otros' => 0];
        $this->get_all();
        $this->populate_referers();

        foreach ($this->referers as $procedence => $thereferers) {
            if ($procedence != 'nulo') {
                foreach ($thereferers as $referer) {
                    if (str_contains($referer->referer, $this->fb))
                        $referers['facebook'] += $referer->conteo;
                    elseif (str_contains($referer->referer, $this->gg))
                        $referers['google'] += $referer->conteo;
                    elseif (str_contains($referer->referer, $this->vb))
                        $referers['votoenblanco'] += $referer->conteo;
                    elseif (str_contains($referer->referer, $this->vbt))
                        $referers['testvb'] += $referer->conteo;
                    else
                        $referers['otros'] += $referer->conteo;
                }
            }
        }

        return $referers;
    }

    public function nulos(){
       return ['total' => $this->tt, 'nulos' =>$this->referers['nulo']->conteo];
    }

    public function detail()
    {
        $this->get_all();
        $this->populate_referers();

        $referers = ['facebook' => 0, 'facebook_mobile' => 0, 'google' => 0, 'votoenblanco' => 0, 'votoenblanco_sections' => 0, 'votoenblanco_editors' => 0, 'votoenblanco_otras_notas' => 0, 'otros' => 0];

        foreach ($this->referers['facebook'] as $referer) {
            if (str_contains($referer->referer, $this->mfb))
                $referers['facebook_mobile'] += $referer->conteo;
            elseif (str_contains($referer->referer, $this->fb))
                $referers['facebook'] += $referer->conteo;
        }

        foreach ($this->referers['google'] as $referer)
            $referers['google'] += $referer->conteo;

        foreach ($this->referers['votoenblanco'] as $referer) {
            if (str_contains($referer->referer, $this->vbn))
                $referers['votoenblanco_otras_notas'] += $referer->conteo;
            elseif (str_contains($referer->referer, $this->vbe)) 
                $referers['votoenblanco_editors'] += $referer->conteo;
            elseif (str_contains($referer->referer, $this->vbc)) 
                $referers['votoenblanco_sections'] += $referer->conteo;
            elseif (str_contains($referer->referer, $this->vb))
                $referers['votoenblanco'] += $referer->conteo;
        }

        foreach ($this->referers['otros'] as $referer)
            $referers['otros'] += $referer->conteo;

        return $referers;
    }

    private function populate_referers()
    {
        foreach ($this->referentes as $referer) {
            if ($referer->referer == null)
                $this->referers['nulo'] = $referer;
            else {
                $this->tt += $referer->conteo;
                if (str_contains($referer->referer, $this->fb))
                    $this->referers['facebook'][] = $referer;
                elseif (str_contains($referer->referer, $this->gg))
                    $this->referers['google'][] = $referer;
                elseif (str_contains($referer->referer, $this->vb))
                    $this->referers['votoenblanco'][] = $referer;
                elseif (str_contains($referer->referer, $this->vbt))
                    $this->referers['testvb'][] = $referer;
                else
                    $this->referers['otros'][] = $referer;
            }
        }
        
    }
}
