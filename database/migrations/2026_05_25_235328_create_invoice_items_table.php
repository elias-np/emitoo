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
        Schema::create('invoice_items', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();

            $table->foreignId('company_service_id')
                ->nullable()
                ->constrained('company_services')
                ->nullOnDelete();

            $table->string('descricao');
            $table->string('codigo_servico_municipal', 20)->nullable();
            $table->string('codigo_tributario_municipio', 20)->nullable();
            $table->string('cnae', 10)->nullable();

            $table->decimal('quantidade', 10, 4)->default(1);
            $table->decimal('valor_unitario', 12, 2);
            $table->decimal('valor_total', 12, 2);

            $table->decimal('aliquota_iss', 5, 4)->default(0);
            $table->boolean('iss_retido')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_items');
    }
};
