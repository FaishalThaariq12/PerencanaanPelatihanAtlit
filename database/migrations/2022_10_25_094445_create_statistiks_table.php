<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('statistiks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('rolepemain');
            $table->string('image_pemain')->nullable();
            $table->integer('speed');
            $table->integer('dribble');
            $table->integer('passing');
            $table->integer('tackles');
            $table->integer('durability');
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
        Schema::dropIfExists('statistiks');
    }
}
