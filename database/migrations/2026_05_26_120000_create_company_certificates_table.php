<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('company_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();

            $table->string('certificate_type', 20);
            $table->string('identification', 20);
            $table->date('valid_from')->nullable();
            $table->date('valid_to')->nullable();

            $table->string('file_disk', 40)->default('local');
            $table->string('file_path', 500);
            $table->string('file_name', 255);
            $table->string('file_extension', 10)->nullable();
            $table->string('file_mime', 100)->nullable();
            $table->string('file_hash', 64);
            $table->text('certificate_password');

            $table->timestamps();

            $table->index(['company_id', 'valid_to']);
            $table->index('identification');
            $table->unique(['company_id', 'file_hash']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_certificates');
    }
};
