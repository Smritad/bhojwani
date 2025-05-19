
<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('project_walk_throughs', function (Blueprint $table) {
            $table->id();
            $table->string('background_image')->nullable();
            $table->string('video')->nullable();
            $table->text('headings')->nullable(); // Comma separated
            $table->text('pdfs')->nullable(); // Comma separated

            // Audit fields
            $table->unsignedBigInteger('created_by')->nullable()->after('pdfs');
            $table->unsignedBigInteger('updated_by')->nullable()->after('created_by');
            $table->unsignedBigInteger('deleted_by')->nullable()->after('updated_by');
            $table->softDeletes(); // adds deleted_at TIMESTAMP NULL
            
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('project_walk_throughs');
    }
};
