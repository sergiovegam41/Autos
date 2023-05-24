<?php

namespace App\Http\Controllers\facturacion;

use App\Http\Controllers\Controller;
use App\Models\CmsUser;
use App\Models\Orders;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;

class FacturacionController extends Controller
{
    public function __invoke()
    {

       $OrdenId = Request()['id'];
       $order = Orders::find($OrdenId);


       if(CRUDBooster::myPrivilegeId() && $OrdenId && $order){

           $is_it_billed = (bool)$order->is_it_billed;
           $CumpleConElRoll =  CRUDBooster::myPrivilegeId() == CmsUser::Contador || CRUDBooster::isSuperadmin() || CRUDBooster::myPrivilegeId() == CmsUser::AdministradorDeTienda;

           if($CumpleConElRoll && $is_it_billed == false){

               return view('/Facturacion/formularioFacturacion',compact('order'));

           }

           return view('/Facturacion/VerFacturacion',compact('order'));
       }
       return redirect("./admin");
    }
}
