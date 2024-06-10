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
        Schema::create('accounts', function (Blueprint $table) {
         $table->id('account_id');
         $table->foreignId('users_id')->constrained()->cascadeOnDelete();
         $table->string('iban')->unique();
         $table->integer('pin')->unique();
         $table->float('bank_balance');
         $table->rememberToken();
         $table->timestamps();});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
