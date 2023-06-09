<?php

namespace App\Http\Controllers;

use App\Models\Prospectos;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewContactWts extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        if ( $request->header('TOKEN') == env('TOKEN') ) {
            $numero = $request->celular;

            if ($numero == null) {
                return response()->json([
                    'status' => "false",
                ]);
            };

            $prospecto = Prospectos::where('contact_1', $numero)->orWhere('contact_2', $numero)->get()->first();

            if ($prospecto == null) {
                $prospecto = new Prospectos();
                $prospecto->contact_1 = $numero;
//                $prospecto->user_id = "1";
                $prospecto->status = "Por Contactar";
                $prospecto->stores_id = 1;
            }


            $prospecto->type_prospecto_id = DB::table('type_prospectos')->where("name","LIKE","%SPIRNET%")->first()->id;
            $prospecto->description = $prospecto->description . " ## Escribió via Whatsapp - ".now()." ##";
            $prospecto->save();

            return response()->json([ 'status' => "true", ]);

        }else{
            return response()->json([
                'status' => "false",
                'data' => "unauthorized",
            ]);
        }
    }
}
