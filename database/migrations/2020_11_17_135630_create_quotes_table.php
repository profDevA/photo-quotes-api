<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->text('quote');
            $table->string('visibleComments')->nullable();
            $table->string('hiddenComments')->nullable();
            $table->boolean('visible')->default(0);
            $table->dateTime('dataAdded')->nullable();
            $table->integer('referenceId1')->nullable();
            $table->integer('referenceId2')->nullable();
            $table->integer('referenceId3')->nullable();
            $table->integer('referenceId4')->nullable();
            $table->string('quoteOfTheDay')->nullable();
            $table->integer('bookId')->nullable();
            $table->string('senderEmail')->nullable();
            $table->string('senderName')->nullable();
            $table->integer('sourceId')->nullable();
            $table->string('sourceName')->nullable();
            $table->string('IPAddress')->nullable();
            $table->string('addedByUser')->nullable();
            $table->string('originalQuote')->nullable();
            $table->string('quoteType')->nullable();
            $table->boolean('new')->nullable();
            $table->boolean('turnVisible')->nullable();
            $table->string('page')->nullable();
            $table->boolean('quoteCountVisible')->nullable();
            $table->dateTime('newDate')->nullable();
            $table->string('rssFeedType');
            $table->string('adminRssfeedType');
            $table->boolean('isEdited')->nullable();
            $table->decimal('rating')->nullable();
            $table->boolean('isEnglish')->nullable();
            $table->string('tags')->nullable();
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
        Schema::dropIfExists('quotes');
    }
}
