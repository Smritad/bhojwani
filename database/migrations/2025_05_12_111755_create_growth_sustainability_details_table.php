<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGrowthSustainabilityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('growth_sustainability_details', function (Blueprint $table) {
            $table->id();
            $table->json('thumbnail_images')->nullable(); // To store the thumbnails (as JSON)
            $table->json('heading')->nullable(); // To store headings (as JSON)
            $table->json('title')->nullable(); // To store titles (as JSON)
            $table->string('sustainability_title'); // To store the sustainability title
            $table->string('sustainability_image')->nullable(); // To store sustainability image path
            $table->text('sustainability_description'); // To store sustainability description
            $table->unsignedBigInteger('created_by'); // To store the user who created the record
            $table->timestamps(); // To store created_at and updated_at timestamps

            // Foreign key constraint (optional)
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('growth_sustainability_details');
    }
}
