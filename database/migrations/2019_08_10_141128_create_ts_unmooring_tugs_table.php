<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsUnmooringTugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts_unmooring_tugs', function (Blueprint $table) {
            $table->bigIncrements('umt_id');
            $table->integer('ts_id');
            $table->string('unmr_tug_name', 350)->nullable();
            $table->dateTime('unmr_tug_fl');
            $table->dateTime('unmr_tug_af');
            $table->dateTime('unmr_tug_na');
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
        Schema::dropIfExists('ts_unmooring_tugs');
    }
}
