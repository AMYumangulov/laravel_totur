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
        Schema::create('profile_subscriber', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->index()->constrained('profiles');
            $table->foreignId('subscriber_id')->index()->constrained('profiles');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscribing_subscriber');
    }
};
