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
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();
            $table->string('workspace_id');
            $table->string('reservation_id')->unique();
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->string('topic');
            $table->json('meeting')->nullable();
            $table->string('reserve_for')->nullable();
            $table->string('status')->default('checked_in');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
