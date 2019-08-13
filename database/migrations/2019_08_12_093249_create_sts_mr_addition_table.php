<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStsMrAdditionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sts_mr_addition', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('ts_id');
            $table->dateTime('hose_con_fl')->nullable();
            $table->dateTime('hose_con_af')->nullable();
            $table->dateTime('hose_con_na')->nullable();
            $table->dateTime('con_gauge_etc_fl')->nullable();
            $table->dateTime('con_gauge_etc_af')->nullable();
            $table->dateTime('con_gauge_etc_na')->nullable();
            $table->dateTime('checklist4_fl')->nullable();
            $table->dateTime('checklist4_af')->nullable();
            $table->dateTime('checklist4_na')->nullable();
            $table->dateTime('cargo_oper_fl')->nullable();
            $table->dateTime('cargo_oper_af')->nullable();
            $table->dateTime('cargo_oper_na')->nullable();
            $table->dateTime('hose_discon_fl')->nullable();
            $table->dateTime('hose_discon_af')->nullable();
            $table->dateTime('hose_discon_na')->nullable();
            $table->dateTime('discon_gauge_etc_fl')->nullable();
            $table->dateTime('discon_gauge_etc_af')->nullable();
            $table->dateTime('discon_gauge_etc_na')->nullable();
            $table->dateTime('checklist5_fl')->nullable();
            $table->dateTime('checklist5_af')->nullable();
            $table->dateTime('checklist5_na')->nullable();
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
        Schema::dropIfExists('sts_mr_addition');
    }
}
