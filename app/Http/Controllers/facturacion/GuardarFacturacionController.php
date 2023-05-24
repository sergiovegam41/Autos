<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use App\Models\CmsUser;
use App\Models\Orders;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
//use Psy\Util\Str;
use Illuminate\Support\Str;

class GuardarFacturacionController extends Controller
{
    public function __invoke()
    {



//      dd(CRUDBooster::myPrivilegeId() );
//
////        redirect("youtube.com");
////        dd("Yes");
//
        $request = Request();
        $OrdenId = $request['id'];
        $order = Orders::find($OrdenId);

        if(CRUDBooster::myPrivilegeId() && $OrdenId && $order){


            $is_it_billed = (bool)$order->is_it_billed;
            $CumpleConElRoll =  CRUDBooster::myPrivilegeId() == CmsUser::Contador || CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == CmsUser::AdministradorDeTienda;

            if($CumpleConElRoll && $is_it_billed == false){


                 if( request()->hasFile("imagen") ){

                    $imagen = request()->file("imagen");
                    $nombreimagen = Str::slug($order->order_number).".".$imagen->guessExtension();
                    $ruta = public_path("/storage/Facturaciones");
                    $path = $ruta."/".$nombreimagen;
                    copy($imagen->getRealPath(),$path);

                    $order->invoice_number = $request->invoice_number;
                    $order->url_invoice_picture = "/storage/Facturaciones/".$nombreimagen;

                    $order->is_it_billed = true;
                    $order->save();

//                    dd("asdasd");
                    return redirect('admin/Facturacion?id='.$OrdenId);
                 }


            }

            return redirect('admin/Facturacion?id='.$OrdenId);
        }
        return redirect("./admin");
    }
}
