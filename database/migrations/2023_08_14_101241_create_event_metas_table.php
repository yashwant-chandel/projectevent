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
            $table->text('text_editor',5555)->nullable();
            $table->string('right_image_with_left_text_caption')->nullable();
            $table->string('right_image_with_left_text_image')->nullable();
            $table->text('right_image_with_left_text_description',5555)->nullable();
            $table->string('left_image_with_right_text_caption')->nullable();
            $table->string('left_image_with_right_text_image')->nullable();
            $table->text('left_image_with_right_text_description',5555)->nullable();
            $table->string('gallery_section_images')->nullable();
            $table->string('contact_section_address')->nullable();
            $table->string('contact_section_contact')->nullable();
            $table->string('contact_section_email')->nullable();
            $table->string('contact_section_site_address')->nullable();
            $table->text('footer_disclaimer',5555)->nullable();
            $table->integer('event_id');
            $table->integer('section_id');
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
