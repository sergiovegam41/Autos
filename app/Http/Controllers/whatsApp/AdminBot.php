<?php

namespace App\Http\Controllers\whatsApp;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppBotsModel;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;

class AdminBot extends Controller
{
    public function __invoke()
    {
        if(!CRUDBooster::isSuperadmin()){
            return redirect('./');
        }

     $bot = WhatsAppBotsModel::where('_id',(Request("_id")))->first();

     $response = $this->getCurrentConfig($bot['url']);
     if($response == "false"){
       $img_qr = $bot['url']."\qr";
       return view("BotWhatsApp/ScanQr", compact('img_qr'));
     }

    $bot_current_config = json_decode($response);


     return view("BotWhatsApp/ConfigBot",compact('bot_current_config','bot'));




    }


    private function getCurrentConfig($url){


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url.'/get-current-config',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);

       return $response;


    }

}
