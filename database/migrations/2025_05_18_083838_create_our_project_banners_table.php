<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOurProjectBannersTable extends Migration
{
    public function up()
    {
        Schema::create('our_project_banners', function (Blueprint $table) {
            $table->id();
            $table->string('banner_heading');
            $table->string('banner_image'); // store filename
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->softDeletes(); // adds deleted_at
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('our_project_banners');
    }
}
