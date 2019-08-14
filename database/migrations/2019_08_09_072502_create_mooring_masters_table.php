<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMooringMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mooring_masters', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->integer('user_id');
			$table->string('short_code', 50);
			$table->text('address');
			$table->string('phone_no');
			$table->string('email', 100);
			$table->string('company_id');
			$table->string('acc_no');
			$table->decimal('salary', 14,2);
			$table->string('resume');
			$table->integer('status_id');
			$table->date('date_recruit');
			$table->tinyInteger('status')->default('1');
			$table->integer('created_by');
            $table->integer('updated_by');
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
        Schema::dropIfExists('mooring_masters');
    }
}
