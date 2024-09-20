<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplacementTable extends Migration
{
    /**
     * Run the migrations.
     * @param string article | артикул поиска
     * @param string analog | варинат аналога
     * @return void
     */
    public function up()
    {
        Schema::create('replacement', function (Blueprint $table) {
            $table->string('article', 255);
            $table->string('analog', 255);
            $table->index('article');
            // Добавление уникального индекса на поля 'analog' и 'article'
            // чтобы избежать дублей
            $table->unique(['analog', 'article'], 'uniq');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replacement');
    }
}
