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
        Schema::table('customers', function (Blueprint $table) {
            $table->string('tipo_pessoa', 20)->default('fisica')->after('id');
            $table->string('apelido', 150)->nullable()->after('nome');
            $table->string('whatsapp', 20)->nullable()->after('telefone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn([
                'tipo_pessoa',
                'apelido',
                'whatsapp',
            ]);
        });
    }
};
