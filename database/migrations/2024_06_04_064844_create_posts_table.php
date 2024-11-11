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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id'); // Kolom untuk menyimpan ID kategori
            $table->string('media');
            $table->string('title');
            $table->text('content');
            $table->timestamps();

            // Indeks untuk kunci asing
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            // cascade artinya jika kategori dihapus, semua postingan yang terkait dengan kategori tersebut juga akan dihapus
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
