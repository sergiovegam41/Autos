<?php

namespace App\Console\Commands\Order;

use App\Models\Orders;
use App\Models\Prospectos;
use App\Models\ShippingAgents;
use Illuminate\Console\Command;
use App\Repositories\Order\Contracts\EloquentOrderRepositoryInterface;


class Fix extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Fix:prospectos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    /**
     * @var EloquentOrderRepositoryInterface
     */
    private $orderRepository;

    public function __construct(
        EloquentOrderRepositoryInterface $orderRepository
    )
    {
        parent::__construct();
        $this->orderRepository = $orderRepository;
    }

//    public function __construct()
//    {
//        parent::__construct();
//    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {

            $IdAsesores = [
                "19"
            ];

            $Prospectos = Prospectos::where('status','Por Contactar')->where('user_id','10')->get()->pluck('id');

            $this->info( "prospectos: ".count($Prospectos));
            $this->info( "Asesores: ".count($IdAsesores));

            $partes = intval(count($Prospectos) / count($IdAsesores));

            $this->info( "Se dividen en: ".$partes);
            $lista = array_chunk($Prospectos->toArray(),$partes,true);

            foreach ( $lista as $index  => $prospectosPart ){
                $AsesorID = $IdAsesores[$index];
                $this->info( $AsesorID ." => ".count($prospectosPart));

                if($AsesorID){
                    $this->info('update');
                    foreach( $prospectosPart as $prosectoId ){
                        Prospectos::where('id',$prosectoId)->update([
                            'user_id'=>$AsesorID,
                        ]);
                    }
                }


            }
//            \Log::debug('SUCCESS - fix:updateOrders');
            $this->info("SUCCESS");
        }catch (\Exception $e){
            $this->info("ERROR");
        }



        return 0;
    }
}
