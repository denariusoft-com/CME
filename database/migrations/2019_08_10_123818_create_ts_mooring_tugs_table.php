<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTsMooringTugsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ts_mooring_tugs', function (Blueprint $table) {
            $table->bigIncrements('mt_id');
            $table->integer('ts_id');
            $table->string('mr_tug_name', 350)->nullable();
            $table->dateTime('mr_tug_firstline');
            $table->dateTime('mr_tug_allfast');
            $table->dateTime('mr_tug_noraccepted');
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
        Schema::dropIfExists('ts_mooring_tugs');
    }
}
