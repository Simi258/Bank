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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('users_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('accounts_id')->references('account_id')->on('accounts')->onDelete('cascade');
            $table->string('to_iban')->constrained()->cascadeOnDelete();
            $table->string('from_iban');
            $table->string('from_name');
            $table->string('to_name');
            $table->string('transaction_description');
            $table->string('transaction_title');
            $table->enum('transaction_type', ['debit', 'credit']);
            $table->enum('transaction_process', ['pending', 'accepted','declined'])->default('accepted');
            $table->decimal('amount');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
