<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompanysettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companysetting', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('company_name', 350);
            $table->string('contact_person', 350)->nullable();
            $table->longText('address')->nullable();
            $table->string('country', 350)->nullable();
            $table->string('state', 350)->nullable();
            $table->string('city', 350)->nullable();
            $table->string('postal_code', 350)->nullable();
            $table->string('email', 350)->nullable();
            $table->string('phone_no', 350)->nullable();
            $table->string('mobile_no', 350)->nullable();
            $table->string('fax', 350)->nullable();
            $table->string('website_url', 350)->nullable();
            $table->tinyInteger('status')->default('1');
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'))->nullable();
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
        Schema::dropIfExists('companysetting');
    }
}
