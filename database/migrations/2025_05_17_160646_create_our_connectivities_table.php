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
        Schema::create('connectivity_details', function (Blueprint $table) {
    $table->id();
    $table->string('section1_heading');
    $table->text('section1_description');

    // Multiple section 2 entries
    $table->text('section2_icons')->nullable(); // comma-separated paths
    $table->text('section2_headings')->nullable(); // comma-separated headings
    $table->longText('section2_project_titles')->nullable(); // comma-separated
    $table->longText('section2_project_matters')->nullable(); // comma-separated

    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_connectivities');
    }
};
