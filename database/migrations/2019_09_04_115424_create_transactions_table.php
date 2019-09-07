<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('moor_mas_id')->nullable();
			$table->integer('ts_id')->nullable();
			$table->dateTime('datetime')->nullable();
			$table->integer('client_id')->nullable();
			$table->integer('ratemas_id')->nullable();
			$table->string('tot_hrs', 50)->nullable();
			$table->string('exceed_hrs', 50)->nullable();
			$table->string('bas_sal_amt', 50)->nullable();
			$table->string('exhrs_amt', 50)->nullable();
			$table->string('totpay_amt', 50)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
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
        Schema::dropIfExists('transactions');
    }
}
