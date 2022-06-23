<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->string('customer_name')->nullable();
            $table->string('customer_mobile')->nullable();
            $table->integer('vehicles_count')->nullable();
            $table->text('note')->nullable();
            $table->date('date')->nullable();
            $table->time('arrival_time')->nullable();
            $table->time('return_time')->nullable();
            $table->double('price',10,2)->nullable();
            $table->double('prepaid_price',10,2)->nullable();
            $table->double('remaining_price',10,2)->nullable();
            $table->string('invoice_number')->nullable();
            $table->enum('payment_type',['cash','cheque','bank'])->nullable();
//            $table->unsignedBigInteger('agent_id')->nullable();
            $table->foreignId('agent_id')->nullable()->constrained('agents');
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
        Schema::dropIfExists('trips');
    }
}
