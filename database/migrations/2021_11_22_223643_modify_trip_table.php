<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyTripTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->foreignId('reservation_type_id')->nullable()->constrained('trip_types');
            $table->string('reservation_type_text')->nullable();
            $table->enum('vehicle_number',['one','more_one'])->nullable();
            $table->enum('vehicle_type',['small','large'])->nullable();
            $table->enum('trip_type',['going_and_back','going','back'])->nullable();
            $table->text('going_note')->nullable();
            $table->text('going_path')->nullable();
            $table->text('back_note')->nullable();
            $table->text('back_path')->nullable();
            $table->foreignId('going_driver_id')->nullable()->constrained('drivers');
            $table->foreignId('back_driver_id')->nullable()->constrained('drivers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('trips', function (Blueprint $table) {
            //
        });
    }
}
