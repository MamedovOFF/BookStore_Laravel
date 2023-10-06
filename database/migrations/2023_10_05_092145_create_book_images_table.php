<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('book_images', function (Blueprint $table) {
            $table->id();
            $table->string('image');
            $table->string('url');
            $table->timestamps();

            $table->unsignedBigInteger('book_id')->nullable();

            $table->foreign('book_id')->on('books')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('book_images');
    }
};
