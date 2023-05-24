<?php


namespace App\Repositories\stock\updateStockMongo;


use App\Models\Categories;
use App\Models\StockMongo;
use App\Models\Stores;
use App\Models\WhatsAppBotsModel;
use App\Repositories\stock\StockRepo;
use App\Repositories\stock\updateStockMongo\Contracts\UpdateStockMongoInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class UpdateStockMongoRepository implements UpdateStockMongoInterface
{

    public function updateCommersialsPages(){

        $route = 'https://api-stock.tanuncia.net/api/v1/update_commercials_pages';
        if( env('APP_IN_TESTING') ){
            return true;
//            $route = 'https://api-test-stock.tanuncia.net/api/v1/update_commercials_pages';
        }
        Http::get($route);
        return true;
    }

    public function updateStock($sede){

        try{
//            dd($sede);

            DB::beginTransaction();
//            $sede = 1;

            $list_product = StockRepo::getLastStock($sede);

            //TODO IMPLEMENT LA ACTUALIZACION DE LAS DIFERENTES SEDES
            StockMongo::truncate();

            $prontStock = "Stock actual de Productos:\n";
            $prontIsEmpy = true;
            foreach ($list_product as $product){

                $store_identification_number = Stores::where('identification_number',  $product['stores_id'])
                    ->select("identification_number")
                    ->first()
                    ->identification_number;

                $stock = new StockMongo();
                $stock->id_product = $product['id_product'];
                $stock->picture = $product['picture'];
                $stock->name = $product['name'];
                $stock->quantity = $product['quantity'];
                $stock->price = $product['price'];
                $stock->commercial_sale_price = $product['commercial_sale_price'];
                $stock->discount = $product['discount'];
                $stock->type = $product['type'];
                $stock->categories_id = Categories::find( $product['categories_id'])->name;
                $stock->incomplete = $product['incomplete'];
                $stock->store_identification_number = $store_identification_number;
                $stock->is_public = $product['is_public'];
                $stock->public_description = $product['public_description'];
                $stock->kit = json_encode($product['kit']);
                $stock->save();

                if( $product['is_public'] ){
                    $prontIsEmpy = false;
                    $prontStock .="\n - ".$product['name'].", ".number_format($product['commercial_sale_price']) .", cantidad: ".$product['quantity'].". imagen:".$product['picture'];
                }

            }

            $fecha_hora_actual = date('Y-m-d H:i:s');

            $prontStock = "Fecha y hora actuales: ".$fecha_hora_actual."\n".$prontStock;
            $prontStock .= "\nAl mostrar el stock, es mejor usar un formato simple y sin imágenes, solo mostrar nombre, cantidad, precios en COP para facilitar la visualización y evitar sobrecargar la pantalla.";

            $bot = WhatsAppBotsModel::where('store_id',strval($sede))->first();

            if($bot){
                if($prontIsEmpy){
                    $this->updateBotWhatsAppByUrlAndPront($bot->url,$prontStock."\nNo hay stock disponible.");
                }else{
                     $this->updateBotWhatsAppByUrlAndPront($bot->url,$prontStock);
                }
            }

            DB::commit();

        }catch (\Exception $exception) {
            \Log::debug($exception);
        }
    }

    private function updateBotWhatsAppByUrlAndPront($url,$pront){


//        echo $url;
//        echo "\n".$pront;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $url.'/set-all-config',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode(array(
                "PostProntAssist" => $pront
            )),
            CURLOPT_HTTPHEADER => array(
              'Accept: application/json',
              'Content-Type: application/json'
            ),
            ));

            $response = curl_exec($curl);

//            echo "\n".$response;

            curl_close($curl);
//            dd($pront);
            return $response;

    }


}
