<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectskyhighluxuriesTable extends Migration
{
    public function up()
    {
        Schema::create('projectskyhighluxuries', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('description');
            $table->text('svg_images')->nullable(); // comma-separated filenames
            $table->text('titles')->nullable();     // comma-separated titles
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('projectskyhighluxuries');
    }
}
