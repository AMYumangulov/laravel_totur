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
        Schema::create('chat_profile', function (Blueprint $table) {
            $table->id();

            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->foreignId('chat_id')->index()->constrained('chats');


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_profile');
    }
};
