<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStsTsAdditionalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sts_ts_additional', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ts_id');
            $table->string('wind', 350)->nullable();
            $table->string('sea', 350)->nullable();
            $table->string('swell', 350)->nullable();
            $table->string('product', 350)->nullable();
            $table->float('tonnes_discharge', 14, 3)->nullable();
            $table->float('tonnes_loading', 14, 3)->nullable();
            $table->float('barrels_discharge', 14, 3)->nullable();
            $table->float('barrels_loading', 14, 3)->nullable();
            $table->longText('incident_occured');
            $table->longText('overtime_remarks');
            $table->dateTime('commence_operation')->nullable();
            $table->dateTime('complete_operation')->nullable();
            $table->float('total_exceed_hrs', 14, 3)->nullable();
            $table->longText('delays_remark');
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
        Schema::dropIfExists('sts_ts_additional');
    }
}
