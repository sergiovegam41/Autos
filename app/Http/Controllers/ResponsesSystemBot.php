<?php

namespace App\Http\Controllers;

use App\Models\ConfigModel;
use App\Models\Customers;
use App\Models\Orders;
use App\Models\Prospectos;
use App\Repositories\stock\StockRepo;
use Illuminate\Http\Request;
use \App\Repositories\BotWhatsApp\BotWhatsApp;

class ResponsesSystemBot extends Controller
{

    const hostPoe = "https://principalpoebot.onrender.com";
  static  function  whatsapp_webhook($phone, $message,$purge){

    $gpt_response = self::sendGptMessage($phone,"Cliente: ".$message,'send',"2",$purge);

      try {
          $result = self::parseJson($gpt_response);

          $decode = json_decode(json_encode(["message"=>$result[0], "accion"=>$result[1]]));

//          dd($decode->message);
         if($decode){

             BotWhatsApp::senMessage($phone,$decode->message);

             if(strlen($decode->accion)>0 && strtolower($decode->accion)!="void"){
                 self::executeAction($decode->accion,$phone);
             }

         }else{
             BotWhatsApp::senMessage($phone,$gpt_response);
         }

      }catch (\Exception $e){
//          dd($e);
          BotWhatsApp::senMessage($phone,"Error 🥵");
      }

    return true;

    }


    static function executeAction($code = "void",$phone){

        switch ($code) {
            case "clear":
                self::sendGptMessage($phone,".",'purge',"2",true);
                BotWhatsApp::senMessage($phone,"El historial ha sido borrado con éxito.");

                break;
            case "perfil":

               try {
                   BotWhatsApp::senMessage($phone,"consultando perfil asociado a: $phone");


                   $info = Prospectos::where('contact_1',$phone)->first();

                   if($info){
                       $info = $info->toArray();
                       $mjs = "ID:".$info['id']."\nNombre: ".$info['names']."\nApellidos: ".$info['last_names']."\nTelefono: ".$info['contact_1']."\nEmail: ".$info['email_1']."\nDireccion: ".$info['adress'];
                       BotWhatsApp::senMessage($phone,$mjs);
                   }else{
                       BotWhatsApp::senMessage($phone,"No se encontraron datos.");
                   }

               }catch (\Exception $exception){
                   BotWhatsApp::senMessage($phone,"No se encontraron datos.");
               }
                break;
            case "order":

                BotWhatsApp::senMessage($phone,"consultando ordenes asociadas a: $phone");
                $customer = Customers::where('phone',$phone)->first();
                $orders = Orders::where('customers_id', $customer->id )->get()->toArray();
                BotWhatsApp::senMessage($phone,json_encode($orders));

                break;
            case "stock":

                BotWhatsApp::senMessage($phone,"consultando stock actual...");
                $stock = StockRepo::getLastStock(1);
                BotWhatsApp::senMessage($phone,json_encode($stock));

                break;
        }

    }

    static function sendGptMessage($phone, $message,$method = "send",$botID="2", $purge = false): string {


        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => self::hostPoe."/".$method,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode([
                "token"=>"1224",
                "message"=>$message,
                "phone"=>$phone,
                "purge"=>$purge,
//                "bot"=>$bot,
                "defaultProntID"=>$botID
            ]),
            CURLOPT_HTTPHEADER => array(
                'Accept: application/json',
                'Content-Type: application/json'
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        $resp = json_decode($response);
        if($method == "purge"){
           return "";
        }

        return $resp->data->message;

    }
    function parseJson($jsonString) {
        $texto1 = explode('{"message":"',trim($jsonString));
        $texto = explode('","accion":"', $texto1[1]);
        if(count($texto)<2){
            $texto = explode('", "accion":"', $texto1[1]);
        }
        $action = explode('"}', $texto[1])[0];
        $message = $texto[0];
        return array($message,$action);
    }
}
