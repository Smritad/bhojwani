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
    Schema::create('skyhighluxuries', function (Blueprint $table) {
        $table->id();
        $table->string('headings'); // For the heading
        $table->text('description'); // For the description
        $table->text('titles'); // To store the titles as a comma-separated string
        $table->text('svg_images'); // To store SVG image names as a comma-separated string
        $table->foreignId('created_by')->constrained('users'); // Assuming you're storing user who created
        $table->foreignId('updated_by')->nullable()->constrained('users'); // To store the user who last updated
        $table->timestamps(); // To store created_at and updated_at
        $table->softDeletes(); // Optional: to mark as deleted instead of removing records permanently
    });
}


    public function down()
{
    Schema::dropIfExists('skyhighluxuries');
}

};
