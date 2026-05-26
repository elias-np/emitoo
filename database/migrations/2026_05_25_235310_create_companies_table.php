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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();

            $table->string('razao_social');
            $table->string('nome_fantasia')->nullable();
            $table->string('cnpj', 14)->unique();
            $table->string('inscricao_municipal', 20)->nullable();
            $table->string('inscricao_estadual', 20)->nullable();
            $table->enum('regime_tributario', [
                'Simples Nacional',
                'Lucro Presumido',
                'Lucro Real',
                'MEI',
            ])->default('Simples Nacional');
            $table->boolean('optante_simples_nacional')->default(true);
            $table->boolean('incentivador_cultural')->default(false);

            $table->string('endereco');
            $table->string('endereco_numero', 20)->nullable();
            $table->string('endereco_complemento', 100)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade');
            $table->char('estado', 2);
            $table->string('cep', 8);

            $table->string('telefone', 20)->nullable();
            $table->string('email')->nullable();

            $table->string('certificado_digital_path', 500)->nullable();
            $table->string('certificado_senha')->nullable();
            $table->enum('nfse_environment', ['homologacao', 'producao'])->default('homologacao');

            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
