<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('our_project_details', function (Blueprint $table) {
            $table->id();
            $table->string('project_heading');
            $table->string('slug');
            $table->string('location');
            $table->string('banner_image');
            $table->string('project_image');
            $table->foreignId('category_id')->constrained('our_project_categories');
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('our_project_details');
    }
};
