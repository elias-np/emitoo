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
        Schema::create('company_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();

            $table->string('codigo_servico_municipal', 20);
            $table->string('codigo_tributario_municipio', 20)->nullable();
            $table->string('cnae', 10)->nullable();
            $table->string('descricao');
            $table->decimal('aliquota_iss', 5, 4)->default(0);
            $table->boolean('iss_retido')->default(false);
            $table->boolean('is_default')->default(false);
            $table->boolean('active')->default(true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_services');
    }
};
