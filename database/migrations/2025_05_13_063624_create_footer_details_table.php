<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('footer_details', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->string('address');
            $table->string('url');
            $table->string('contact_number');
            $table->text('about');
            $table->json('social_media')->nullable(); // JSON for storing social media links
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->timestamp('deleted_at')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('footer_details');
    }
}
