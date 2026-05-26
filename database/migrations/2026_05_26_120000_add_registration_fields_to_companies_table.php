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
        Schema::table('companies', function (Blueprint $table) {
            $table->string('contato')->nullable()->after('nome_fantasia');
            $table->string('pais', 80)->default('Brasil')->after('cidade');
            $table->string('natureza_juridica', 30)->nullable()->after('regime_tributario');
            $table->date('data_abertura')->nullable()->after('natureza_juridica');
            $table->string('porte', 50)->nullable()->after('data_abertura');
            $table->string('cnae_primario_codigo', 20)->nullable()->after('porte');
            $table->string('cnae_primario_descricao')->nullable()->after('cnae_primario_codigo');
            $table->json('cnaes_secundarios')->nullable()->after('cnae_primario_descricao');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'contato',
                'pais',
                'natureza_juridica',
                'data_abertura',
                'porte',
                'cnae_primario_codigo',
                'cnae_primario_descricao',
                'cnaes_secundarios',
            ]);
        });
    }
};
