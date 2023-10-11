<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use function Laravel\Prompts\table;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->string('type');
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('ISBN');
            $table->unsignedBigInteger('amount');
            $table->unsignedBigInteger('author_id');
            $table->longText('description');
            $table->foreign('author_id')->on('authors')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
