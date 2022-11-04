<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Config;
use Vendor\myfb\Facebook;

class Fb extends Model
{
    use HasFactory;
    private $access_token   = "";
    private $user_id        = "";
    private $url            = "https://graph.facebook.com/v15.0/";
    private $url_token      ="https://graph.facebook.com/";

    public function post_fb($post)
    {
        //require_once(env('APP_URL') . 'vendor/myfb/facebook.php');
  /*      https://graph.facebook.com/oauth/access_token?grant_type=fb_exchange_token&
  client_id=APP-ID&
  client_secret=APP-SECRET&
  fb_exchange_token=SHORT-LIVED-USER-ACCESS-TOKEN
*/
        $app_id     = '667771518306459'; // Sustituimos las X por el ID de nuestra aplicación
        $app_secret = 'a91f644b8887c013ab8131808969ade7'; // Sustituimos las X por el Secret de nuestra aplicación
        $token_short = "EAAJfVawjyJsBAN2WvUgmQyMmUksXXmZCLPorMuMXSvmdJ30KCbxt9KoTZBGxHDzTEZAz5iqJ3m7l741SKCo7R5pD42oyZCqY9Aq7OWnRc99yIZBCduB6zo4nVaoenGYNmJZBtvPd6uy39L1O5Y3Sk8q2FWu5MIZCLPrsiJ6ZAFZAIYVmGOOuqz5JZBIWDhojkBoWkhV8BbhvJ8RwZDZD";
        $token = 'EAAJfVawjyJsBAJqzW9kLXYsrgltPIrIKfB5zxKAARa8KwFi0iZC2WytqODT1uBSh5s0a2olzQ3cRezrWHN6ZAmZAZCixnNXZBHboXYd6lsCr5v3ygiI1H1cfOnsvvmPzYyNfQurqRZBO7uQeE7aVXeVPvUp8leqc7QZCLZC1GZCLj2mH7HxhKqp1M9F3TU9BAgoifNUPCQJiLAY0hUTRTMhRKh4HFXRFaS8UZD'; // ponemos nuestro token
    /*
        https://www.facebook.com/v15.0/dialog/oauth?
        client_id={app-id}
        &redirect_uri={redirect-uri}
        &state={state-param}
  */
        $ch = curl_init();//PAGE-ID?fields=access_token&access_token=USER-ACCESS-TOKEN";
   curl_setopt($ch, CURLOPT_URL, $this->url_token.$app_id."fields=access_token&access_token=$token_short"); 
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
   curl_setopt($ch, CURLOPT_HEADER, 0); 
   $data = curl_exec($ch); 
   curl_close($ch); 
   echo $data; 
        echo "ñ.ñ";
        die;
    }
}
