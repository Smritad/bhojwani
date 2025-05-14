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
        Schema::create('our_project_categories', function (Blueprint $table) {
            $table->id();

            // Category name and slug
            $table->string('category_name');
            $table->string('slug')->nullable()->after('category_name');

            // User tracking columns
            $table->unsignedBigInteger('created_by')->nullable(); // ID of the user who created the category
            $table->unsignedBigInteger('updated_by')->nullable(); // ID of the user who last updated the category
            $table->unsignedBigInteger('deleted_by')->nullable(); // ID of the user who deleted the category

            // Timestamps
            $table->timestamps(); // created_at and updated_at timestamps
            $table->softDeletes(); // deleted_at for soft deletes
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('our_project_categories');
    }
};
