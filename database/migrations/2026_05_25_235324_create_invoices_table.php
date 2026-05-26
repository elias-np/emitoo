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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers')->restrictOnDelete();
            $table->foreignId('sale_id')->nullable()->constrained('sales')->nullOnDelete();
            $table->foreignId('company_service_id')->nullable()->constrained('company_services')->nullOnDelete();

            $table->string('numero_nota', 20)->nullable()->index();
            $table->string('serie', 10)->default('1');
            $table->dateTime('data_emissao')->index();
            $table->date('data_competencia');
            $table->string('codigo_verificacao')->nullable();
            $table->string('protocolo', 100)->nullable();

            $table->enum('status', [
                'draft',
                'processing',
                'authorized',
                'cancelled',
                'rejected',
                'error',
            ])->default('draft')->index();

            $table->decimal('valor_servicos', 12, 2);
            $table->decimal('valor_deducoes', 12, 2)->default(0);
            $table->decimal('valor_pis', 12, 2)->default(0);
            $table->decimal('valor_cofins', 12, 2)->default(0);
            $table->decimal('valor_inss', 12, 2)->default(0);
            $table->decimal('valor_ir', 12, 2)->default(0);
            $table->decimal('valor_csll', 12, 2)->default(0);
            $table->decimal('valor_iss', 12, 2)->default(0);
            $table->decimal('aliquota_iss', 5, 4)->default(0);
            $table->decimal('valor_liquido', 12, 2);

            $table->boolean('iss_retido')->default(false);
            $table->enum('responsavel_retencao', ['tomador', 'prestador'])->nullable();

            $table->string('codigo_municipio', 7)->nullable();
            $table->string('codigo_servico_municipal', 20)->nullable();
            $table->string('codigo_tributario_municipio', 20)->nullable();
            $table->text('descricao');

            $table->string('xml_path', 500)->nullable();
            $table->string('pdf_path', 500)->nullable();
            $table->string('link_autenticidade', 500)->nullable();

            $table->text('motivo_cancelamento')->nullable();
            $table->timestamp('cancelled_at')->nullable();

            $table->string('error_code', 50)->nullable();
            $table->text('error_message')->nullable();

            $table->enum('nfse_environment', ['homologacao', 'producao']);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
