<?php

namespace App\Repositories\BotWhatsApp;


use App\Models\ConfigModel;
use App\Models\WhatsAppBotsModel;
use Carbon\Carbon;
use function Illuminate\Events\queueable;

class BotWhatsApp
{
    static public function senMessage($phone, $message):bool{

        $HostBotWhatsApp = ConfigModel::where('name','HostBotWhatsApp')->first();
        $token = \App\Models\ConfigModel::where('name', 'TokenWebhook')->first();

        try {

            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $HostBotWhatsApp->value."/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode([
                    "token"=>$token->value,
                    "message"=>$message,
                    "phone"=>$phone
                ]),
                CURLOPT_HTTPHEADER => array(
                    'Accept: application/json',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);



//            dd($response);
            curl_close($curl);

            return true;
        }catch (\Exception $exception){
            return false;
        }


    }

    static  function ping(string $url):string
    {

        try {



                $curl = curl_init();

                curl_setopt_array($curl, array(
                    CURLOPT_URL => $url."/ping",
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Accept: application/json'
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
//                dd($response);

            return $response;
        }catch (\Exception $exception){
            return $exception;
        }

    }
}
