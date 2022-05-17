<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->unsignedInteger('res_id')->index();
            $table->date('start_date');
            $table->date('end_date');
            $table->double('total_amount');
            $table->string('location');
            // $table->string('dropoff_location');
            $table->string('room_id');
            $table->integer('SSN');
            $table->boolean('paid');
            $table->unsignedBigInteger('user_id');
            $table->foreign('room_id')->references("room_id")->on('rooms')->onUpdate('cascade')->onDelete('restrict');
            $table->foreign(['SSN','user_id'])->references(['SSN','user_id'])->on('customers')->onUpdate('cascade')->onDelete('restrict');
            $table->primary(['SSN', 'user_id','room_id','res_id']);
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
        Schema::dropIfExists('reservations');
    }
}
