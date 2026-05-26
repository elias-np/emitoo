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
        Schema::create('invoice_logs', function (Blueprint $table) {
            $table->id();

            $table->foreignId('invoice_id')->constrained('invoices')->cascadeOnDelete();
            $table->foreignId('performed_by')->nullable()->constrained('users')->nullOnDelete();

            $table->enum('action', [
                'created',
                'queued',
                'sent',
                'authorized',
                'cancelled',
                'rejected',
                'retried',
                'error',
            ])->index();

            $table->string('status_before', 30)->nullable();
            $table->string('status_after', 30)->nullable();

            $table->unsignedSmallInteger('http_status')->nullable();
            $table->string('error_code', 50)->nullable();
            $table->text('error_details')->nullable();

            $table->longText('payload_sent')->nullable();
            $table->longText('response_received')->nullable();

            $table->json('meta')->nullable();

            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_logs');
    }
};
