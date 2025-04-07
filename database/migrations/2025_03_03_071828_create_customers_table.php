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
            $table->string('name');  // Sloupec pro jméno
            $table->string('email')->unique();  // Sloupec pro email, s unikátními hodnotami
            $table->string('adress');  // Sloupec pro adresu
            $table->string('phoneNumber');  // Sloupec pro telefonní číslo
            $table->decimal('discount', 5, 2)->nullable();  // Sloupec pro slevu (volitelný, formát: číslo s 2 desetinnými místy)
            $table->timestamps();  // Sloupce created_at a updated_at
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
