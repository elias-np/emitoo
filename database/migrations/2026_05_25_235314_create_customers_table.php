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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->string('nome');
            $table->string('email')->unique();
            $table->string('cpf_cnpj', 14)->nullable()->index();
            $table->string('telefone', 20)->nullable();

            $table->string('endereco')->nullable();
            $table->string('endereco_numero', 20)->nullable();
            $table->string('endereco_complemento', 100)->nullable();
            $table->string('bairro', 100)->nullable();
            $table->string('cidade')->nullable();
            $table->char('estado', 2)->nullable();
            $table->string('cep', 8)->nullable();
            $table->char('pais', 2)->default('BR');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
