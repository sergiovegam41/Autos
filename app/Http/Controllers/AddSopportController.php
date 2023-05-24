<?php

namespace App\Http\Controllers;

use App\Models\CmsUser;
use App\Models\Inventory;
use App\Models\Stores;
use App\Models\Support;
use App\Models\SupportStatus;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;

class AddSopportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $admin_path = config('crudbooster.ADMIN_PATH') ?: 'admin';

        if (CRUDBooster::myPrivilegeId() == null) {
            $url = url($admin_path . '/login');
            return redirect($url)->with('message', trans('crudbooster.not_logged_in'));
        }

        if(!CRUDBooster::isSuperadmin() && CRUDBooster::myPrivilegeId() != CmsUser::Tecnico ){
            $url = url($admin_path . '/');
            return redirect($url)->with('message', trans('crudbooster.not_logged_in'));
        }

        $request = Request();

        if( $request->id ){

            $data = Inventory::where('id', $request->id)
                ->with('order')
                ->with('support')
                ->where('order_id','!=',null)
                ->orderBy('id', 'desc')
                ->first();

            $SopportStatus = SupportStatus::get();
            $SopportStatus = !$SopportStatus ?[] : $SopportStatus->toArray();
            $FinalData = !$data?[] : $data->toArray();

//            dd('Success');
            return view('Sopport.AddSopport',compact('FinalData','SopportStatus'));

        }else{
            return redirect('admin/searchSopport');
        }
    }

    public  function exceptionForm(){

        $SopportStatus = SupportStatus::get();
        $SopportStatus = !$SopportStatus ?[] : $SopportStatus->toArray();

        $storesList = Stores::get();
        $storesList = !$storesList ?[] : $storesList->toArray();


        return view('Sopport.AddExceptionSopport',compact('SopportStatus','storesList'));
    }

    public  function exceptionSave(Request $request){
        $sopport = Support::create([
            'Asunto'=>$request->motivo,
            'Descripcion'=>'Imai: '.$request->imai.'<br/> Asesor: '.$request->asesor.'<br/>Cliente: '.$request->cliente.'<br/> Descripcion: '.$request->descripcion,
            'status'=>$request->status_id,
            'stores_id'=>$request->stores_id,

        ]);

       return redirect('admin/support');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = Inventory::where('id', $request->id)
            ->with('order')
            ->with('support')
            ->where('order_id','!=',null)
            ->orderBy('id', 'desc')
            ->first();

        $sopport = Support::create([
            'Asunto'=>$request->motivo,
            'Descripcion'=>$request->descripcion,
            'status'=>$request->status_id,
            'order_id'=>$data->order['id'],
            'imei_id'=>$request->id,
            'asesor_id'=>$data->order['user_id'],
            'customers_id'=>$data->order['customers_id'],
            'stores_id'=>$data->order['stores_id'],
        ]);

        return redirect('admin/searchSopport?buscar='.$data->imei);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
