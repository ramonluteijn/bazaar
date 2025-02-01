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
        Schema::create('content_blocks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('content_page_id')->constrained()->onDelete('cascade');
            $table->string('type');
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->string('author')->nullable();
            $table->text('image')->nullable();
            $table->text('video')->nullable();
            $table->text('background_color')->nullable();
            $table->string('button_link')->nullable();
            $table->string('site_link')->nullable();
            $table->string('link_text')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('content_blocks');
    }
};
