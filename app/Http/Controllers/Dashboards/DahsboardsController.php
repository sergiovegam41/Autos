<?php

namespace App\Http\Controllers\Dashboards;

use App\Http\Controllers\Controller;
use App\Models\CmsUser;
use App\Models\Customers;
use App\Models\Orders;
use Carbon\Carbon;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;
setlocale(LC_ALL, 'es_ES');
\Carbon\Carbon::setLocale('es');

class DahsboardsController extends Controller
{

    public function __invoke()
    {


            if(CRUDBooster::myPrivilegeId()){
//            return CRUDBooster::myPrivilegeId();
                if(CRUDBooster::isSuperadmin()){

                    $datos = $this->getDashboardAdmin();
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());

                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));
                }

                if(CRUDBooster::myPrivilegeId() == \App\Models\CmsUser::AdministradorDeTienda){


                    $datos = $this->getDashboardAdmin();
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());
                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));
//                    return view('dashboards/dashboardTiendaAdmin');
                }

                if(CRUDBooster::myPrivilegeId() == \App\Models\CmsUser::AsesorComercial){


                    $datos = $this->getDashboardAdminByUserId(CRUDBooster::myId());
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());

                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));

//                 return view('dashboards/dashboardAsesor');
                }

                if(CRUDBooster::myPrivilegeId() == \App\Models\CmsUser::Coordinador){

                    $datos = $this->getDashboardAdmin();
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());
                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));
//                    return view('dashboards/dashboardCoordinador');
                }

                if(CRUDBooster::myPrivilegeId() == \App\Models\CmsUser::OperadorBodega){

                    $datos = $this->getDashboardAdmin();
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());
                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));
//                    return view('dashboards/dashboardOperadorBodega');
                }

                if(CRUDBooster::myPrivilegeId() == \App\Models\CmsUser::Tecnico){

                    $datos = $this->getDashboardAdmin();
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());
                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));
//                    return view('dashboards/dashboardTecnico');
                }

                if(CRUDBooster::myPrivilegeId() == \App\Models\CmsUser::Contador){
                    $datos = $this->getDashboardAdmin();
                    $data = json_encode($datos['graficas']);
                    $counts = $datos['counts'];
                    $porSalir = array_reverse($datos['porSalir']->toArray());
                    return view('dashboards/dashboardAdmin',compact('data','counts','porSalir'));
                }


                return view('dashboards/dashboardGeneric');



            }

            return redirect('admin/login');

        }

        private function getDashboardAdmin(){


            $primer_dia_2_mes_antes = Carbon::now()->startOfMonth()->subMonth()->subMonth()->toDateString();
            $ultimo_dia_2_mes_antes = Carbon::now()->subMonth()->subMonth()->endOfMonth()->toDateString();

            $primer_dia_1_mes_antes = Carbon::now()->startOfMonth()->subMonth()->toDateString();
            $ultimo_dia_1_mes_antes = Carbon::now()->subMonth()->endOfMonth()->toDateString();

            $primer_dia_mes = Carbon::now()->startOfMonth()->toDateString();
            $uiltimo_dia_mes= Carbon::now()->endOfMonth()->toDateString();

            $meses = null;


            $fechaMesActual = Carbon::parse($primer_dia_mes);
            $nombreMesActual = $fechaMesActual->format("F");

            $meses[$nombreMesActual] = [
               1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0,
               10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0,
               20=>0, 21=>0, 22=>0, 23=>0, 24=>0, 25=>0, 26=>0, 27=>0, 28=>0, 29=>0,
               30=>0, 31=>0
            ];

            $fecha1MesAntes = Carbon::parse($primer_dia_1_mes_antes);
            $nombre1MesAntes = $fecha1MesAntes->format("F");

            $meses[$nombre1MesAntes] = [
               1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0,
               10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0,
               20=>0, 21=>0, 22=>0, 23=>0, 24=>0, 25=>0, 26=>0, 27=>0, 28=>0, 29=>0,
               30=>0, 31=>0
            ];

            $fecha2MesAntes = Carbon::parse($primer_dia_2_mes_antes);
            $nombre2MesAntes = $fecha2MesAntes->format("F");
            $meses[$nombre2MesAntes] = [
               1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0,
               10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0,
               20=>0, 21=>0, 22=>0, 23=>0, 24=>0, 25=>0, 26=>0, 27=>0, 28=>0, 29=>0,
               30=>0, 31=>0
            ];


            //Mes Actual
            $OrdenesMesActual = Orders::whereBetween('orders.created_at', [$primer_dia_mes, $uiltimo_dia_mes])->where('status','!=',Orders::CANCELADA)->where('stores_id',CmsUser::getStoresId())->get();
            $maxDay = 0;
            foreach ( $OrdenesMesActual as $orden){
               $dia = intval(explode( "-",explode(" ",$orden->created_at)[0])[2]);
               $meses[$nombreMesActual][$dia] += 1;
               if($maxDay < $dia){
                   $maxDay = $dia;
               }

            }

            // Un mes Antes
            $Ordenes1MesAntes = Orders::whereBetween('orders.created_at', [$primer_dia_1_mes_antes, $ultimo_dia_1_mes_antes])->where('status','!=',Orders::CANCELADA)->where('stores_id',CmsUser::getStoresId())->get();

            foreach ( $Ordenes1MesAntes as $orden){
               $dia = intval(explode( "-",explode(" ",$orden->created_at)[0])[2]);
               $meses[$nombre1MesAntes][$dia] += 1;
            }

            // dos mes Antes
            $Ordenes2MesAntes = Orders::whereBetween('orders.created_at', [$primer_dia_2_mes_antes, $ultimo_dia_2_mes_antes])->where('status','!=',Orders::CANCELADA)->where('stores_id',CmsUser::getStoresId())->get();

            foreach ( $Ordenes2MesAntes as $orden){
               $dia = intval(explode( "-",explode(" ",$orden->created_at)[0])[2]);
               $meses[$nombre2MesAntes][$dia] += 1;
            }

            $meses[$nombreMesActual] = array_slice($meses[$nombreMesActual], 0,$maxDay);
            $meses[$nombre1MesAntes] = array_slice($meses[$nombre1MesAntes], 0,$maxDay);
            $meses[$nombre2MesAntes] = array_slice($meses[$nombre2MesAntes], 0,$maxDay);


            // Ordenes entegradas mes
            $entregadas = $OrdenesMesActual->where('status',Orders::ENTREGADO)->count();
            $enProceso =  $OrdenesMesActual->where('status','!=',Orders::CANCELADA)->where('status','!=',Orders::ENTREGADO);
            $cientes = Customers::where('stores_id',CmsUser::getStoresId())->get()->count();

           $OrdenesTorta = Orders::whereBetween('orders.created_at', [$primer_dia_mes, $uiltimo_dia_mes])->where('stores_id',CmsUser::getStoresId())->get();
           $EN_VALIDACIONs = $OrdenesTorta->where('status',Orders::EN_VALIDACION)->count();
           $ALISTAMIENTOs  = $OrdenesTorta->where('status',Orders::ALISTAMIENTO)->count();
           $GUIA_GENERADAs = $OrdenesTorta->where('status',Orders::GUIA_GENERADA)->count();
           $EN_REPARTOs    = $OrdenesTorta->where('status',Orders::EN_REPARTO)->count();
           $ENTREGADOs     =  $OrdenesTorta->where('status',Orders::ENTREGADO)->count();
           $CANCELADAs     = $OrdenesTorta->where('status',Orders::CANCELADA)->count();

           $torta = ["EN_VALIDACIONs"=>$EN_VALIDACIONs,"ALISTAMIENTOs"=>$ALISTAMIENTOs,"GUIA_GENERADAs"=>$GUIA_GENERADAs,"EN_REPARTOs"=>$EN_REPARTOs,"ENTREGADOs"=>$ENTREGADOs,"CANCELADAs"=>$CANCELADAs];

            return ['graficas'=>["meses"=> $meses,"torta"=>$torta],"counts"=>["entregadas"=>$entregadas,"enProceso"=>$enProceso->count(),"cientes"=>$cientes],"porSalir"=>$enProceso];
        }


    private function getDashboardAdminByUserId($UserID){


        $primer_dia_2_mes_antes = Carbon::now()->startOfMonth()->subMonth()->subMonth()->toDateString();
        $ultimo_dia_2_mes_antes = Carbon::now()->subMonth()->subMonth()->endOfMonth()->toDateString();

        $primer_dia_1_mes_antes = Carbon::now()->startOfMonth()->subMonth()->toDateString();
        $ultimo_dia_1_mes_antes = Carbon::now()->subMonth()->endOfMonth()->toDateString();

        $primer_dia_mes = Carbon::now()->startOfMonth()->toDateString();
        $uiltimo_dia_mes= Carbon::now()->endOfMonth()->toDateString();

        $meses = null;


        $fechaMesActual = Carbon::parse($primer_dia_mes);
        $nombreMesActual = $fechaMesActual->format("F");

        $meses[$nombreMesActual] = [
            1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0,
            10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0,
            20=>0, 21=>0, 22=>0, 23=>0, 24=>0, 25=>0, 26=>0, 27=>0, 28=>0, 29=>0,
            30=>0, 31=>0
        ];

        $fecha1MesAntes = Carbon::parse($primer_dia_1_mes_antes);
        $nombre1MesAntes = $fecha1MesAntes->format("F");

        $meses[$nombre1MesAntes] = [
            1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0,
            10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0,
            20=>0, 21=>0, 22=>0, 23=>0, 24=>0, 25=>0, 26=>0, 27=>0, 28=>0, 29=>0,
            30=>0, 31=>0
        ];

        $fecha2MesAntes = Carbon::parse($primer_dia_2_mes_antes);
        $nombre2MesAntes = $fecha2MesAntes->format("F");
        $meses[$nombre2MesAntes] = [
            1=>0, 2=>0, 3=>0, 4=>0, 5=>0, 6=>0, 7=>0, 8=>0, 9=>0,
            10=>0, 11=>0, 12=>0, 13=>0, 14=>0, 15=>0, 16=>0, 17=>0, 18=>0, 19=>0,
            20=>0, 21=>0, 22=>0, 23=>0, 24=>0, 25=>0, 26=>0, 27=>0, 28=>0, 29=>0,
            30=>0, 31=>0
        ];


        //Mes Actual
        $OrdenesMesActual = Orders::whereBetween('orders.created_at', [$primer_dia_mes, $uiltimo_dia_mes])->where('status','!=',Orders::CANCELADA)->where('stores_id',CmsUser::getStoresId())->where('user_id',$UserID)->get();
        $maxDay = 0;
        foreach ( $OrdenesMesActual as $orden){
            $dia = intval(explode( "-",explode(" ",$orden->created_at)[0])[2]);
            $meses[$nombreMesActual][$dia] += 1;
            if($maxDay < $dia){
                $maxDay = $dia;
            }

        }

        // Un mes Antes
        $Ordenes1MesAntes = Orders::whereBetween('orders.created_at', [$primer_dia_1_mes_antes, $ultimo_dia_1_mes_antes])->where('status','!=',Orders::CANCELADA)->where('stores_id',CmsUser::getStoresId())->where('user_id',$UserID)->get();

        foreach ( $Ordenes1MesAntes as $orden){
            $dia = intval(explode( "-",explode(" ",$orden->created_at)[0])[2]);
            $meses[$nombre1MesAntes][$dia] += 1;
        }

        // dos mes Antes
        $Ordenes2MesAntes = Orders::whereBetween('orders.created_at', [$primer_dia_2_mes_antes, $ultimo_dia_2_mes_antes])->where('status','!=',Orders::CANCELADA)->where('stores_id',CmsUser::getStoresId())->where('user_id',$UserID)->get();

        foreach ( $Ordenes2MesAntes as $orden){
            $dia = intval(explode( "-",explode(" ",$orden->created_at)[0])[2]);
            $meses[$nombre2MesAntes][$dia] += 1;
        }

        $meses[$nombreMesActual] = array_slice($meses[$nombreMesActual], 0,$maxDay);
        $meses[$nombre1MesAntes] = array_slice($meses[$nombre1MesAntes], 0,$maxDay);
        $meses[$nombre2MesAntes] = array_slice($meses[$nombre2MesAntes], 0,$maxDay);


        // Ordenes entegradas mes
        $entregadas = $OrdenesMesActual->where('status',Orders::ENTREGADO)->count();
        $enProceso =  $OrdenesMesActual->where('status','!=',Orders::CANCELADA)->where('status','!=',Orders::ENTREGADO);
        $cientes = Customers::where('stores_id',CmsUser::getStoresId())->get()->where('user_id',$UserID)->count();

        $OrdenesTorta = Orders::whereBetween('orders.created_at', [$primer_dia_mes, $uiltimo_dia_mes])->where('stores_id',CmsUser::getStoresId())->where('user_id',$UserID)->get();
        $EN_VALIDACIONs = $OrdenesTorta->where('status',Orders::EN_VALIDACION)->count();
        $ALISTAMIENTOs  = $OrdenesTorta->where('status',Orders::ALISTAMIENTO)->count();
        $GUIA_GENERADAs = $OrdenesTorta->where('status',Orders::GUIA_GENERADA)->count();
        $EN_REPARTOs    = $OrdenesTorta->where('status',Orders::EN_REPARTO)->count();
        $ENTREGADOs     =  $OrdenesTorta->where('status',Orders::ENTREGADO)->count();
        $CANCELADAs     = $OrdenesTorta->where('status',Orders::CANCELADA)->count();

        $torta = ["EN_VALIDACIONs"=>$EN_VALIDACIONs,"ALISTAMIENTOs"=>$ALISTAMIENTOs,"GUIA_GENERADAs"=>$GUIA_GENERADAs,"EN_REPARTOs"=>$EN_REPARTOs,"ENTREGADOs"=>$ENTREGADOs,"CANCELADAs"=>$CANCELADAs];

        return ['graficas'=>["meses"=> $meses,"torta"=>$torta],"counts"=>["entregadas"=>$entregadas,"enProceso"=>$enProceso->count(),"cientes"=>$cientes],"porSalir"=>$enProceso];
    }

}
