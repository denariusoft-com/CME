<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStsTsOperTimingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sts_ts_oper_timings', function (Blueprint $table) {
            $table->bigIncrements('stot_id');
            $table->integer('ts_id'); 
            $table->dateTime('support_craft_transit_start')->nullable();
            $table->dateTime('support_craft_transit_finish')->nullable();
            $table->dateTime('support_craft_transit_notes')->nullable();
            $table->dateTime('fendering_start')->nullable();
            $table->dateTime('fendering_finish')->nullable();
            $table->dateTime('fendering_notes')->nullable();
            $table->dateTime('checklist2_start')->nullable();
            $table->dateTime('checklist2_finish')->nullable();
            $table->dateTime('checklist2_notes')->nullable();
            $table->dateTime('checklist3_start')->nullable();
            $table->dateTime('checklist3_finish')->nullable();
            $table->dateTime('checklist3_notes')->nullable();
            $table->dateTime('mooring_firstline')->nullable();
            $table->dateTime('mooring_allfast')->nullable();
            $table->dateTime('mooring_noraccepted')->nullable();
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
        Schema::dropIfExists('sts_ts_oper_timings');
    }
}
