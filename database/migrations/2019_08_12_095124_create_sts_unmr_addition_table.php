<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStsUnmrAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sts_unmr_addition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ts_id');
            $table->dateTime('unmooring_firstline')->nullable();
            $table->dateTime('unmooring_allfast')->nullable();
            $table->dateTime('unmooring_noraccepted')->nullable();
            $table->dateTime('unfendering_fl')->nullable();
            $table->dateTime('unfendering_af')->nullable();
            $table->dateTime('unfendering_na')->nullable();
            $table->dateTime('unmr_support_craft_fl')->nullable();
            $table->dateTime('unmr_support_craft_af')->nullable();
            $table->dateTime('unmr_support_craft_na')->nullable();
            $table->dateTime('rigging_ashore_fl')->nullable();
            $table->dateTime('rigging_ashore_af')->nullable();
            $table->dateTime('rigging_ashore_na')->nullable();            
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
        Schema::dropIfExists('sts_unmr_addition');
    }
}
