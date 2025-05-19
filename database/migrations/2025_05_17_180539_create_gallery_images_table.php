<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleryImagesTable extends Migration
{
    public function up()
    {
        Schema::create('gallery_images', function (Blueprint $table) {
            $table->id();
            $table->string('section1_heading');
            $table->text('images')->nullable(); // comma-separated filenames

            // User tracking fields
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();

            $table->timestamps(); // created_at & updated_at
            $table->softDeletes(); // adds deleted_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('gallery_images');
    }
}
