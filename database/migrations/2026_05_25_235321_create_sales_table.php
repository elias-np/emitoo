<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();
            $table->foreignId('customer_id')->nullable()->constrained('customers')->nullOnDelete();
            $table->foreignId('import_batch_id')->nullable()->constrained('import_batches')->nullOnDelete();

            $table->string('external_order_id')->unique();
            $table->string('product_name');
            $table->string('product_external_id')->nullable();
            $table->enum('product_type', ['digital', 'physical', 'service'])->default('digital');
            $table->unsignedTinyInteger('quantity')->default(1);

            $table->decimal('unit_price', 12, 2);
            $table->decimal('total_price', 12, 2);
            $table->decimal('discount_amount', 12, 2)->default(0);

            $table->enum('payment_method', [
                'credit_card',
                'debit_card',
                'pix',
                'boleto',
                'other'
            ])->nullable();
            $table->string('payment_gateway', 50)->nullable()->default('kiwify');
            $table->unsignedTinyInteger('installments')->default(1);

            $table->enum('status', [
                'pending',
                'paid',
                'refunded',
                'chargeback',
                'expired'
            ])->default('pending')->index();

            $table->dateTime('sale_date')->index();
            $table->date('eligible_for_invoice_at')->index();

            $table->boolean('is_duplicate')->default(false)->index();
            $table->foreignId('duplicate_of_sale_id')->nullable()->constrained('sales')->nullOnDelete();
            $table->timestamp('processed_at')->nullable();

            $table->string('kiwify_invoice_id')->nullable();

            $table->text('notes')->nullable();
            $table->json('raw_csv_data')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
