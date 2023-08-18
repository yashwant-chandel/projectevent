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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->string('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->string('place')->nullable();
            $table->string('note')->nullable();
            $table->string('close_date')->nullable();
            $table->string('parent_session')->nullable();
            $table->integer('event_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
