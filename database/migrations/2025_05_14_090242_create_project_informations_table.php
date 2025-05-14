<?php

// database/migrations/xxxx_xx_xx_create_project_informations_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectInformationsTable extends Migration
{
    public function up()
{
    Schema::create('project_informations', function (Blueprint $table) {
    $table->id();
    $table->string('banner_image');
    $table->string('banner_heading');
    $table->text('banner_description');
    $table->string('description_image');
    $table->text('description');
    $table->string('heading');
    $table->text('more_description');
    $table->string('more_image');
    $table->unsignedBigInteger('created_by')->nullable();
    $table->unsignedBigInteger('updated_by')->nullable();
    $table->unsignedBigInteger('deleted_by')->nullable();
    $table->timestamp('deleted_at')->nullable();
    $table->timestamps();
});
}

public function down()
{
    Schema::dropIfExists('project_informations');
}

}
