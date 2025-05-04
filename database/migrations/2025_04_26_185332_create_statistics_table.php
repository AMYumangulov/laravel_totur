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
        Schema::create('statistics', function (Blueprint $table) {
            $table->id();

            $table->unsignedInteger('post_count');
            $table->unsignedInteger('comment_count');
            $table->unsignedInteger('like_count');
            $table->unsignedInteger('post_like_count');
            $table->unsignedInteger('comment_like_count');
            $table->unsignedInteger('view_count');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('statistics');
    }
};
