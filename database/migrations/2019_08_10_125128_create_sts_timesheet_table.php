<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStsTimesheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sts_timesheet', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->string('location', 350)->nullable();
            $table->string('job_ref_id', 350)->nullable();
            $table->string('mother_vessel', 350)->nullable();
            $table->string('maneuvring_vessel', 350)->nullable();
            $table->string('mother_sdwt', 350)->nullable();
            $table->string('manoeuvring_sdwt', 350)->nullable();
            $table->string('mother_loa', 350)->nullable();
            $table->string('manoeuvring_loa', 350)->nullable();
            $table->string('anchored_nort', 350)->nullable();
            $table->dateTime('arrival_nort');
            $table->dateTime('dt_onboard_in');
            $table->dateTime('dt_disembark_out');
            $table->string('cargo', 350)->nullable();
            $table->integer('client_id');
            $table->string('client_fsu_spot', 350)->nullable();
            $table->integer('created_by');
            $table->integer('updated_by');
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sts_timesheet');
    }
}
