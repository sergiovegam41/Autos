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


      try {
            $gpt_response = self::sendGptMessage($phone,$message,'send',"2",$purge);

            $lista = explode('[SPL]', trim($gpt_response));

             BotWhatsApp::senMessage($phone,$lista[0]);

              foreach($lista as $accion){
                  if(strlen($accion)>0 && strtolower($accion)!="void"){
                      self::executeAction(trim(strtolower(explode(" ",$accion)[0])),$phone);
                  }
              }

      }catch (\Exception $e){
//          dd($e);
          BotWhatsApp::senMessage($phone,"Error 🥵");
      }

    return true;

    }


    static function executeAction($code = "void",$phone){

//        dd($code);
        switch ($code) {
            case "clear":
                self::sendGptMessage($phone,".",'purge',"2",true);
                BotWhatsApp::senMessage($phone,"El historial ha sido borrado con éxito.");

                break;
            case "perfil":

               try {
                   BotWhatsApp::senMessage($phone,"Consultando perfil...");


                   $info = Customers::where('phone',$phone)->first();

                   if($info){
                       $info = $info->toArray();
                       $mjs = "ID:".$info['id']."\nNombre: ".$info['name']."\nApellidos: ".$info['last_name']."\nTelefono: ".$info['phone']."\nEmail: ".$info['email']."\nDireccion: ".$info['address'];
                       BotWhatsApp::senMessage($phone,$mjs);
                   }else{
                       BotWhatsApp::senMessage($phone,"No se encontraron datos asociadas a: $phone");
                   }

               }catch (\Exception $exception){
                   BotWhatsApp::senMessage($phone,"No se encontraron datos.");
               }
                break;
            case "order":

                BotWhatsApp::senMessage($phone,"Consultando ordenes...");
                $customer = Customers::where('phone',$phone)->first();
                $orders = Orders::where('customers_id', $customer->id )->get()->toArray();

                if(count($orders) == 0){
                    BotWhatsApp::senMessage($phone,"No tienes ninguna Orden asociada a: $phone");
                }else{
                    foreach ( $orders as $order){
                        $mjs = "ID:".$order['order_number']."\nEstado: ".$order['status']."\nFecha: ".$order['created_at']."\nTotal pagar: ".$order['grand_total'];
                        BotWhatsApp::senMessage($phone,($mjs));
                    }
                }


                break;
            case "stock":

                BotWhatsApp::senMessage($phone,"consultando stock actual...");
                $stock = StockRepo::getLastStock(1);


                if(count($stock) == 0){
                    BotWhatsApp::senMessage($phone,"No tienes ninguna Orden asociada a: $phone");
                }else{
                    foreach ( $stock as $s){
                        $mjs = "Imagen:".$s['picture']."\nNombre: ".$s['name']."\nDisponibles: ".$s['quantity']."\nCosto: ".$s['price']."\nDescripcion: ".$s['public_description'] ;
                        BotWhatsApp::senMessage($phone,($mjs));
                    }
                }

                break;

              case "need_call":

                BotWhatsApp::senMessage($phone,"Ha sido añadido a la cola de atención al cliente, prepárese para recibir una llamada 📞.");
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

        dd($resp);

        return $resp->data->message;

    }
//    function parseJson($jsonString) {
//        $texto1 = explode('{"message":"',trim($jsonString));
//
//
//        $texto = explode('","accion":"', $texto1[1]);
//
//        $action = explode('"}', $texto[1])[0];
//        $message = $texto[0];
//        return array($message,$action);
//    }
}
