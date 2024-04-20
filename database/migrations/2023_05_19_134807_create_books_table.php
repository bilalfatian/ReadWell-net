<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('title');
            $table->text('content');
            $table->string('language');
            $table->string('cover_image')->nullable();
            $table->string('book_path')->nullable();
            $table->boolean('approved')->default(false);
            $table->boolean('hidden')->default(false);
            $table->unsignedBigInteger('views')->default(0);
            $table->float('average_rating')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('books');
    }
}
