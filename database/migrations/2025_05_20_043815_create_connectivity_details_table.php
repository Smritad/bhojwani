<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectivityDetailsTable extends Migration
{
    public function up()
{
    Schema::create('connectivity_details', function (Blueprint $table) {
        $table->id();
        $table->foreignId('project_id')->constrained()->onDelete('cascade');
        $table->string('section1_heading');
        $table->text('section1_description');
        $table->string('section2_headings');
        $table->string('section2_svgs');
        $table->string('section2_project_titles');
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('connectivity_details');
    }
}
