<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sources', function (Blueprint $table) {
            $table->id();
            $table->string('firstName')->nullable();
            $table->string('middleName')->nullable();
            $table->string('lastName')->nullable();
            $table->longText('comments')->nullable();
            $table->longText('bio')->nullable();
            $table->string('urlName')->nullable();
            $table->boolean('visible');
            $table->string('ipAddress')->nullable();
            $table->integer('viewed_Times')->default(0);
            $table->dateTime('viewed_times_date')->nullable();
            $table->string('sourceName')->nullable();
            $table->string('misc')->nullable();
            $table->integer('quoteCountVisible')->nullable();
            $table->string('quoteTitle')->nullable();
            $table->string('metatag')->nullable();
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
        Schema::dropIfExists('sources');
    }
}
