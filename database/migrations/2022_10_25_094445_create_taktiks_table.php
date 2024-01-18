<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaktiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taktiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('image_cover')->nullable();
            $table->string('youtube_url')->nullable();
            $table->text('excerpt');
            $table->text('deskripsi');
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('taktiks');
    }
}
