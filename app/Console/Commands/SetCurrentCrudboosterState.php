<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetCurrentCrudboosterState extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crudbooster:setCurrentState';

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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->startCommand($this);
        return 0;
    }

    static public function startCommand( $info )
    {
        $tables = SaveCurrentCrudboosterState::$TABLES;
        DB::beginTransaction();
        foreach ( $tables as $e){

            DB::table($e)->truncate();
            $current_table = json_decode(file_get_contents("database/seeders/current_state/".$e."_state.json"));

            foreach ( $current_table as $i => $v){
                $values = (array)$v;
                DB::table($e)->insert($values);
            }

            $info->info( $e." Completed.");

        }
        DB::commit();
        $info->info("Success");

    }
}
