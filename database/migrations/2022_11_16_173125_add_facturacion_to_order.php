<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacturacionToOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('orders')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->string('invoice_number')->nullable();
                $table->string('url_invoice_picture')->nullable();
                $table->boolean('is_it_billed')->nullable();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
//        if (Schema::hasTable('orders')) {
//            Schema::table('orders', function (Blueprint $table) {
//                $table->string('invoice_number');
//                $table->string('is_it_billed');
//            });
//        }
    }
}
