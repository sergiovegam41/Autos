<?php

namespace App\Http\Controllers;

use App\Models\CmsUser;
use App\Models\Products;
use App\Models\Recursos;
use Illuminate\Http\Request;

class Preguntas extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];

        $request = Request();

        if($request->page <= 0 ){
            $request->page = 1;
        }

        $limit = 20;
        if($request->limit){
            $limit =  $request->limit;
        }

        $storesId = CmsUser::GetCurrentStore();
        $productos = Products::where('stores_id',$storesId)->with('recursosQuestion')->paginate($limit);

        $generales = [];

        if($request->buscar){
            $generales = Recursos::where('type', Recursos::PREGUNTA_TYPE)->where(function ($query ) use ($request) {
                $query->where('recursos.Asunto', 'LIKE','%'.trim($request->buscar).'%')
                    ->Orwhere('recursos.Descripcion','LIKE','%'.trim($request->buscar).'%');
            })->where('products_id','=',null)->paginate($limit);
        }else{
            $generales = Recursos::where('type', Recursos::PREGUNTA_TYPE)->where('products_id',null)->paginate($limit);
        }

        $recursos = [];
        foreach ($productos as $Product){
            if($Product->recursosQuestion != '[]'){
                array_push($recursos,$Product);
            }
        }

        return view('recursos/preguntas',compact('recursos','generales'));
//        $data = [];
//
//        $storesId = CmsUser::GetCurrentStore();
//
//        $productos = Products::where('stores_id',$storesId)->with('recursosQuestion') ->get();
//
//        $recursos = [];
//
//        foreach ($productos as $Product){
//
//            if($Product->recursosQuestion != '[]'){
//                array_push($recursos,$Product);
//            }
//
//        }
//
//        return view('recursos/preguntas',compact('recursos'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
