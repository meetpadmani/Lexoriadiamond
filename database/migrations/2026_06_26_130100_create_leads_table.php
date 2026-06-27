<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('company')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('source')->default('manual');
            // source: manual, whatsapp, website, meta_lead_ad, meta_click_to_whatsapp, referral
            $table->text('requirement')->nullable();
            $table->string('status')->default('new_lead');
            // Pipeline: new_lead, contacted, requirement_received, quotation_sent,
            //           negotiation, advance_received, designer_assigned, design_in_progress,
            //           quality_check, client_approval, final_payment, delivered, completed
            $table->foreignId('assigned_to')->nullable()->constrained('users')->nullOnDelete();
            $table->string('priority')->default('medium'); // low, medium, high, urgent
            $table->decimal('estimated_value', 12, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('source');
            $table->index('assigned_to');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
