<?php

namespace App\Http\Controllers\whatsApp;

use App\Http\Controllers\Controller;
use App\Models\WhatsAppBotsModel;
use crocodicstudio\crudbooster\helpers\CRUDBooster;
use Illuminate\Http\Request;

class BotWhatsAppManager extends Controller
{
     public function __invoke()
     {
         if(!CRUDBooster::isSuperadmin()){
           return redirect('./');
         }

         $bots = WhatsAppBotsModel::where('active','true')->get()->toArray();

         return view("BotWhatsApp/ViewBots",compact("bots"));

     }
}
