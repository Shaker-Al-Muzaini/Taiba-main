<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('vehicle_number')->nullable();
            $table->string('licence_number')->nullable();
            $table->string('chassis_number')->nullable();
            $table->string('type')->nullable();
            $table->string('color')->nullable();
            $table->integer('capacity')->nullable();
            $table->date('production_date')->nullable();
            $table->date('licence_expire_date')->nullable();
            $table->date('insurance_expire_date')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
}
