<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMapAddressesTable extends Migration
{
    public function up()
    {
        Schema::create('map_addresses', function (Blueprint $table) {
            $table->id();
            $table->string('heading');
            $table->text('map_url');
            $table->string('site_title');
            $table->string('site_address');
        
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('map_addresses');
    }
}
