<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Nonoriginal extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nonoriginal', function(Blueprint $table){
             $table->id();
             $table->string('article');
             $table->string('name');
             $table->string('unit');
             $table->integer('quantity');
             $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('nonoriginal');
    }
}
