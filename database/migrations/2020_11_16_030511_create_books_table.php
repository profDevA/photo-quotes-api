<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->dateTime('pubDate')->nullable();
            $table->string('isbn')->nullable();
            $table->string('amazonUrl')->nullable();
            $table->boolean('visible')->default(0);
            $table->string('visibleComments')->nullable();
            $table->string('hiddenComments')->nullable();
            $table->string('author')->nullable();
            $table->string('source_id')->nullable();
            $table->string('bookImage')->nullable();
            $table->string('bookStoreName')->nullable();
            $table->string('category_id')->nullable();
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
        Schema::dropIfExists('books');
    }
}
