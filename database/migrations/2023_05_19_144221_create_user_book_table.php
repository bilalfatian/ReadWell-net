<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserBookTable extends Migration
{
    public function up()
    {
        Schema::create('user_book', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('book_id');
            $table->boolean('favorite')->default(false);
            $table->boolean('saved')->default(false);
            $table->boolean('later')->default(false);
            $table->boolean('recently_viewed')->default(false);
            $table->decimal('progress', 5, 2)->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_book');
    }
}
