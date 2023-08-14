<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('event_meta', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('section_id');
            $table->string('meta_key');
            $table->integer('meta_value');
            // $table->string('text_editor',2555)->nullable();
            // $table->string('right_section_image')->nullable();
            // $table->string('right_section_name')->nullable();
            // $table->string('right_section_profession')->nullable();
            // $table->string('right_section_phone')->nullable();
            // $table->string('right_section_description',2555)->nullable();
            // $table->string('left_section_image')->nullable();
            // $table->string('left_section_name')->nullable();
            // $table->string('left_section_profession')->nullable();
            // $table->string('left_section_phone')->nullable();
            // $table->string('left_section_description',2555)->nullable();
            // $table->string('gallery_images')->nullable();
            // $table->string('contact_section_address')->nullable();
            // $table->string('contact_section_contact')->nullable();
            // $table->string('contact_section_email')->nullable();
            // $table->string('contact_section_site_address')->nullable();
            // $table->string('footer_disclaimer',2555)->nullable();
            // $table->integer('event_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_meta');
    }
};
