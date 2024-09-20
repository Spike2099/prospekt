<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer', function(Blueprint $table) {
            $table->id();
            $table->string('uuid')->unique();
            $table->string('superintendant', 255);
            $table->string('company', 255);
            $table->string('okved');
            $table->string('inn');
            $table->string('ogrn');
            $table->string('kpp');
            $table->text('address');
            $table->string('ogrn_date', 50);
            //$table->foreign('uuid')->references('verified')->on('users')->onDelete('cascade');
            //$table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}
