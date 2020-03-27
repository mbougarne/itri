<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('seo_id')->nullable();
            $table->unsignedBigInteger('open_graph_id')->nullable();
            $table->string('slug')->nullable();
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('body');
            $table->string('thumbnail')->nullable();;
            $table->boolean('is_published')->default(1);
            $table->timestamps();

            $table->foreign('seo_id')->references('id')->on('seo')->onDelete('set null');
            $table->foreign('open_graph_id')->references('id')->on('open_graphs')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
