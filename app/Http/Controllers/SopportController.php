<?php

namespace App\Http\Controllers;

use App\Models\CmsUser;
use App\Models\Inventory;
use App\Models\SupportStatus;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;

class SopportController extends Controller
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

        $FinalData = [];

        if( $request->buscar ){

            $data = Inventory::where('imei','LIKE', "%".$request->buscar."%")
                ->Orwhere('reference','LIKE', "%".$request->buscar."%")
                ->with('order')
                ->with('support')
                ->where('order_id','!=',null)
                ->orderBy('id', 'desc')
                ->paginate($request->page??10);



            $FinalData = $data->toArray();

//            dd($FinalData);

        }

        return view('Sopport.searchSopport', compact('FinalData'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

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
