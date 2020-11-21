<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('translations', function (Blueprint $table) {
            $table->id();
            $table->string("title");
            $table->string("slug");
            $table->enum("part_speech", \App\Repository\Eloquent\TranslationRepository::PART_SPEECHES);
            $table->bigInteger("word_id")->unsigned();
            $table->foreign("word_id")->references("id")
                ->on("words")->onDelete("cascade");
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
        Schema::dropIfExists('translations');
    }
}
