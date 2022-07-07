<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_translations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title', 255);
            $table->unsignedBigInteger('store_id');
            $table->enum('locale', ['uz', 'ru', 'en']);

            $table->unique(['store_id', 'locale']);
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
        Schema::dropIfExists('store_translations');
    }
}
