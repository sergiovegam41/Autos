<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Soporte extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support', function (Blueprint $table) {
            $table->id();

            $table->string('Asunto')->nullable();
            $table->text('Descripcion')->nullable();

            $table->string('status')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('imei_id')->nullable();
            $table->unsignedBigInteger('asesor_id')->nullable();
            $table->unsignedBigInteger('customers_id')->nullable();
            $table->unsignedBigInteger('stores_id')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support');
    }
}
