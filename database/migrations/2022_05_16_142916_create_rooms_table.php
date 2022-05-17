<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->string('room_id')->primary();
            // $table->string("room_type");
            // $table->string("model");
            // $table->integer("year");
            $table->double("price");
            $table->string("view");
            $table->string("TV");
            $table->string("refrigerator");
            // $table->string("air_conditioner");
            // $table->string("transmission");
            // $table->string("gas_type");
            // $table->string("fuel_consumption");
            // $table->boolean("air_conditioning");
            // $table->boolean("bluetooth");
            $table->boolean("status");
            $table->String("image");
            $table->string("type")->nullable(); 
            $table->foreign('type')->references("type")->on('room_types')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedInteger('branchNo')->nullable();
            $table->foreign('branchNo')->references("branchNo")->on('branches')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
