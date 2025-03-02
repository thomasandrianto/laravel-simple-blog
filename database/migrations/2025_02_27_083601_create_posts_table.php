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
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // foreign key ke users.id
            $table->string('title', 60); // batas maksimum 60 karakter
            $table->text('content');
            $table->string('image_url')->nullable(); // opsional
            $table->enum('status', ['draft', 'scheduled', 'published'])->default('draft'); // status post
            $table->timestamp('published_at')->nullable(); // waktu publikasi jika dijadwalkan
            $table->timestamps();
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
