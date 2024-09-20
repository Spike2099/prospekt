<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contract', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('uuid')->unique();
            $table->string('name');
            $table->string('action');
            $table->string('bank');
            $table->string('rs');
            $table->string('bik');
            $table->string('ks');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->foreign('uuid')->references('verified')->on('users')->onDelete('cascade');
            $table->primary(['uuid']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contract');
    }
}
