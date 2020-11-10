<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255)->nullable();
            $table->longText('text')->nullable();
            $table->string('author', 50)->nullable();
            $table->string('visible')->nullable();
            $table->string('visible_comments', 500)->nullable();
            $table->string('hidden_comments', 255)->nullable();
            $table->integer('source_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('article_type')->nullable();
            $table->string('url')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
