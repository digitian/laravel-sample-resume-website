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
            $table->foreignId('author_id')->constrained('users');
            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->string('keywords')->nullable();
            $table->string('category')->nullable();
            $table->string('image');
            $table->string('slug');
            $table->smallInteger('parent_id')->nullable();
            $table->boolean('status')->default(1);
            $table->string('locale', 3);
            $table->smallInteger('sort')->default(1);
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
